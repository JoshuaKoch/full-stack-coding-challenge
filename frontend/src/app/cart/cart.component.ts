import { Component, OnInit } from '@angular/core';
import { CartService } from '../cart/cart.service';
import { IPizza } from '../pizzas/pizza';
import { Router } from '@angular/router';
import {
  MatSnackBar,
  MatSnackBarVerticalPosition,
} from '@angular/material/snack-bar';
import { AlertComponent } from '../alert/alert.component';

@Component({
  selector: 'app-cart',
  templateUrl: './cart.component.html',
  styleUrls: ['./cart.component.css'],
})
export class CartComponent implements OnInit {
  pizzas: IPizza[] | undefined;
  cartItemCount: number = 0;
  cartPrice: number = 0;
  cartOpen: boolean = false;
  durationInSeconds: number = 10;
  verticalPosition: MatSnackBarVerticalPosition = 'top';

  constructor(
    private cartService: CartService,
    private router: Router,
    private _snackBar: MatSnackBar
  ) {}

  ngOnInit(): void {
    this.cartService.currentCart.subscribe(
      (data: IPizza[]) => (this.pizzas = data)
    );
    this.cartService.currentCartPrice.subscribe(
      (data: number) => (this.cartPrice = data)
    );
    this.cartService.currentCartItemCount.subscribe(
      (data: number) => (this.cartItemCount = data)
    );
  }
  removeItemFromCart(index: number) {
    this.cartService.removeCartItem(index);
  }
  async orderItemsFromCart() {
    await this.cartService.orderCart().subscribe(() => {
      this.router.navigate(['/orders']);
      this.cartOpen = false;
      this.openSnackBar();
    });
  }
  toggleCart() {
    this.cartOpen = !this.cartOpen;
  }
  openSnackBar() {
    this._snackBar.openFromComponent(AlertComponent, {
      duration: this.durationInSeconds * 1000,
      data: 'Order successfully created',
      verticalPosition: this.verticalPosition,
    });
  }
}
