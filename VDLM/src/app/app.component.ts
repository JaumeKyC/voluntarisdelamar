import { Component } from '@angular/core';
import { Router } from '@angular/router';
import { HttpClient } from '@angular/common/http';

@Component({
  selector: 'app-root',
  templateUrl: './app.component.html',
  styleUrls: ['./app.component.css']
})
export class AppComponent {
  title = 'VDLM';
  constructor(private router: Router, private http: HttpClient) { }

  login(email: string, password: string) {
    this.http.post<any>('http://localhost:8000/login', { email, password }).subscribe({
      next: (response) => {
        this.router.navigate(['/home_voluntaris']);
      },
      error: (error) => {
        if (error.status === 403) {
          this.router.navigate(['/login']);
        }
      },
    });
  }


}