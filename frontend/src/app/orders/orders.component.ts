import { Component, OnInit } from '@angular/core';
import { OrdersService } from './orders.service';
import { IOrder } from './order';

@Component({
  selector: 'app-orders',
  templateUrl: './orders.component.html',
  styleUrls: ['./orders.component.css'],
})
export class OrdersComponent implements OnInit {
  orders: IOrder[] | undefined;

  constructor(private ordersService: OrdersService) {}

  ngOnInit(): void {
    this.ordersService
      .getOrders()
      .subscribe((data: IOrder[]) => (this.orders = data));
  }
}
