import { Injectable } from '@angular/core';
import { BehaviorSubject } from 'rxjs';
import { IPizza } from '../pizzas/pizza';
import { HttpClient } from '@angular/common/http';

import { Observable, throwError } from 'rxjs';

@Injectable()
export class CartService {
  private ROOT_URL: string = 'http://127.0.0.1:8000';

  private cart = new BehaviorSubject<IPizza[]>([]);
  currentCart = this.cart.asObservable();

  private cartPrice = new BehaviorSubject<number>(0);
  currentCartPrice = this.cartPrice.asObservable();

  private cartItemCount = new BehaviorSubject<number>(0);
  currentCartItemCount = this.cartItemCount.asObservable();

  constructor(private http: HttpClient) {}

  addCartItem(pizza: IPizza) {
    this.cartPrice.next(this.cartPrice.getValue() + pizza.price);
    this.cart.next(this.cart.getValue().concat([pizza]));
    this.cartItemCount.next(this.cart.getValue().length);
  }
  removeCartItem(index: number) {
    this.cartPrice.next(
      this.cartPrice.getValue() - this.cart.getValue()[index].price
    );
    this.cart.getValue().splice(index, 1);
    this.cartItemCount.next(this.cart.getValue().length);
  }
  orderCart(): Observable<IPizza[]> {
    let response = this.http
      .post<IPizza[]>(this.ROOT_URL + '/order', this.cart.getValue())
      .pipe();
    this.cart.next([]);
    this.cartItemCount.next(0);
    this.cartPrice.next(0);
    return response;
  }
}
