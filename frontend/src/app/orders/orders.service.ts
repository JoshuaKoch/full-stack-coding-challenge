import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';

import { Observable, throwError } from 'rxjs';
import { catchError, retry } from 'rxjs/operators';
import { IOrder } from './order';

@Injectable()
export class OrdersService {
  private ROOT_URL: string = 'http://127.0.0.1:8000';

  constructor(private http: HttpClient) {}

  getOrders(): Observable<IOrder[]> {
    return this.http.get<IOrder[]>(this.ROOT_URL + '/orders');
  }
}
