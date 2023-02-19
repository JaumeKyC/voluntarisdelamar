import { Component, Input, Output, EventEmitter } from '@angular/core';
import { Router } from '@angular/router';
@Component({
  selector: 'app-header',
  templateUrl: './header.component.html',
  styleUrls: ['./header.component.css']
})

export class HeaderComponent {

  constructor(public router: Router) { }

  @Output() cerrarSesion = new EventEmitter<boolean>();


  public nombre_usuario = sessionStorage.getItem('name');
  public apellidos = sessionStorage.getItem('apellidos');



  public logOut(log: boolean) {

    sessionStorage.removeItem('id');
    sessionStorage.removeItem('name');
    sessionStorage.removeItem('apellidos');
    this.cerrarSesion.emit(log);
    this.router.navigate(['login']);
  }
}

