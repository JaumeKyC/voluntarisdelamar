import { Component } from '@angular/core';

@Component({
  selector: 'app-detalle-evento-voluntario',
  templateUrl: './detalle-evento-voluntario.component.html',
  styleUrls: ['./detalle-evento-voluntario.component.css']
})
export class DetalleEventoVoluntarioComponent {

  public hora_inicio : string = "08:30:00";
  public hora_fin : string = "---";
  public maximo_voluntarios: number = 30;
  public contador_voluntarios: number = 15;
  public lugar_evento: string = "C/ Miguel Perez 82";
  public descripcion_evento: string = "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum."
  public titulo_evento: string = "Título Evento";

  public unirse() {
    console.log('TE HAS UNIDO');
  }

}
