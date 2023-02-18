import { Component, Input } from '@angular/core';

@Component({
  selector: 'app-header',
  templateUrl: './header.component.html',
  styleUrls: ['./header.component.css']
})
export class HeaderComponent {

<<<<<<< HEAD
  public nombre_usuario: string = "Raul";
  public apellido1: string = "Hernandez";
  public apellido2: string = "Saez";

  public nombre_apellidos = this.nombre_usuario + " " + this.apellido1 + " " + this.apellido2;

}
=======
  public nombre_usuario = localStorage.getItem('nombre_usuario');
  public apellido1 = localStorage.getItem('apellido1');
  public apellido2 = localStorage.getItem('apellido2');

}
>>>>>>> origin/header
