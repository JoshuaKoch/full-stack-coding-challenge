import { Component, OnInit } from '@angular/core';
import { PizzasService } from './pizzas.service';
import { CartService } from '../cart/cart.service';
import { IPizza } from './pizza';

@Component({
  selector: 'app-pizzas',
  templateUrl: './pizzas.component.html',
  styleUrls: ['./pizzas.component.css'],
})
export class PizzasComponent implements OnInit {
  pizzas: IPizza[] | undefined;

  constructor(
    private pizzasService: PizzasService,
    private cartService: CartService
  ) {}

  ngOnInit() {
    this.pizzasService
      .getPizzas()
      .subscribe((data: IPizza[]) => (this.pizzas = data));
  }

  addItemToCart(pizza: IPizza) {
    this.cartService.addCartItem(pizza);
  }
}
