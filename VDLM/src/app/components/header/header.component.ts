import { Component, Input } from '@angular/core';

@Component({
  selector: 'app-header',
  templateUrl: './header.component.html',
  styleUrls: ['./header.component.css']
})
export class HeaderComponent {

  public nombre_usuario = localStorage.getItem('nombre_usuario');
  public apellido1 = localStorage.getItem('apellido1');
  public apellido2 = localStorage.getItem('apellido2');

}
