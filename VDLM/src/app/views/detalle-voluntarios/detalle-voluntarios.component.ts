
import { Component } from '@angular/core';
import { FormsModule } from '@angular/forms';

@Component({
  selector: 'app-detalle-voluntarios',
  templateUrl: './detalle-voluntarios.component.html',
  styleUrls: ['./detalle-voluntarios.component.css']
})

export class DetalleVoluntariosComponent {
  nombreUsuario: string;
  telefono: string;
  correo: string;

  constructor() {
    this.nombreUsuario = '';
    this.telefono = '';
    this.correo = '';
  }
}  