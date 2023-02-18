import { Component } from '@angular/core';
import { Router } from '@angular/router';

@Component({
  selector: 'app-root',
  templateUrl: './app.component.html',
  styleUrls: ['./app.component.css']
})
export class AppComponent {
  title = 'VDLM';
  loggeado: boolean = true;

  public nombre_usuario = localStorage.setItem('nombre_usuario','Raul');
  public apellido1 = localStorage.setItem('apellido1','Hernandez');
  public apellido2 = localStorage.setItem('apellido2','Saez');

  constructor (public router: Router) {

    if(this.loggeado == true && this.router.url == "/login") {
      this.router.navigate(['/']);
    } 

  }

}