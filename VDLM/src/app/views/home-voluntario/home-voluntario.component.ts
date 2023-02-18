import { Component } from '@angular/core';

@Component({
  selector: 'app-home-voluntario',
  templateUrl: './home-voluntario.component.html',
  styleUrls: ['./home-voluntario.component.css']
})
export class HomeVoluntarioComponent {

  public nombre_usuario = localStorage.getItem('nombre_usuario');
  public apellido1 = localStorage.getItem('apellido1');
  public apellido2 = localStorage.getItem('apellido2');

}
