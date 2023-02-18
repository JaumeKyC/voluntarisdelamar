import { Component } from '@angular/core';
import { Router } from '@angular/router';
import { LoginService } from 'src/app/services/login.service';
import { Login } from '../../models/login';

@Component({
  selector: 'app-login',
  templateUrl: './login.component.html',
  styleUrls: ['./login.component.css']
})
export class LoginComponent {
  email: string = '';
  password: string = '';

  constructor(private dataService: LoginService, private router: Router) { }

  onSubmit(): void {
    const body: Login = {
    email: this.email,
      password: this.password
    };
    this.dataService.login(body).subscribe(
      (response) => {
        // Si la respuesta es exitosa (HTTP 200), redirige a /home_voluntaris
        if (response.status === 200) {
          this.router.navigate(['/home_voluntaris']);
        }
        // Si hay un error (HTTP 403), no hacemos nada y seguimos en /login
      },
      (error) => {
        // Si hay un error en la petición HTTP, muestra el mensaje de error en la consola
        console.log(error);
      }
    );
  }
}