import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { Observable } from 'rxjs';
import { Login } from '../models/login';

@Injectable({
  providedIn: 'root'
})
export class LoginService {

  constructor(private http: HttpClient) { }

  login(loginData: Login): Observable<any> {
    const url = 'https://localhost:8000/api/login';
    return this.http.post(url, loginData);
  }
}
