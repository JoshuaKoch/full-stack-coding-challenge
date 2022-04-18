import { NgModule } from '@angular/core';
import { BrowserModule } from '@angular/platform-browser';

import { AppRoutingModule } from './app-routing.module';
import { AppComponent } from './app.component';
import { PizzasComponent } from './pizzas/pizzas.component';
import { OrdersComponent } from './orders/orders.component';
import { PizzasService } from './pizzas/pizzas.service';
import { OrdersService } from './orders/orders.service';
import { CartService } from './cart/cart.service';
import { BrowserAnimationsModule } from '@angular/platform-browser/animations';
import { HttpClientModule } from '@angular/common/http';

import { MaterialModule } from './material-module';
import { CartComponent } from './cart/cart.component';
import { AlertComponent } from './alert/alert.component';
import { FormsModule } from '@angular/forms';

@NgModule({
  declarations: [
    AppComponent,
    PizzasComponent,
    OrdersComponent,
    CartComponent,
    AlertComponent,
  ],
  imports: [
    BrowserModule,
    AppRoutingModule,
    BrowserAnimationsModule,
    MaterialModule,
    HttpClientModule,
    FormsModule,
  ],
  providers: [PizzasService, CartService, OrdersService],
  bootstrap: [AppComponent],
})
export class AppModule {}
