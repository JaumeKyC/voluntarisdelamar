import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { Observable } from 'rxjs';

@Injectable({
    providedIn: 'root'
})
export class DataService {

    constructor(private http: HttpClient) { }

    public url: string = 'http://localhost:8000/api/login';
    public urlProfile: string = 'http://localhost:8000/api/listProfile/'; 

    public login(username: string, password: string): Observable<any> {
        let auth = { email: username, password: password };
        return this.http.post<any>(this.url, auth, { observe: 'response' });
    }


    public getUser(id: string): Observable <any>{
        return this.http.get<any>(this.urlProfile + id);
      }
}