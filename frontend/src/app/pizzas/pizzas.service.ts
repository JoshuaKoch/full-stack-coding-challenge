import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';

import { Observable, throwError } from 'rxjs';
import { catchError, retry } from 'rxjs/operators';
import { IPizza } from './pizza';

@Injectable()
export class PizzasService {
  private ROOT_URL: string = 'http://127.0.0.1:8000';

  constructor(private http: HttpClient) {}

  getPizzas(): Observable<IPizza[]> {
    return this.http.get<IPizza[]>(this.ROOT_URL + '/pizzas');
  }
}
