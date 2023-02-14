import { Component } from '@angular/core';

@Component({
  selector: 'app-header',
  templateUrl: './header.component.html',
  styleUrls: ['./header.component.css']
})
export class HeaderComponent {

  public nombre_usuario: string = "Raul";
  public apellido1: string = "Hernandez";
  public apellido2: string = "Saez";

  public nombre_apellidos = this.nombre_usuario + " " + this.apellido1 + " " + this.apellido2;

}