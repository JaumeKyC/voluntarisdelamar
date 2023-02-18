import { Component } from '@angular/core';
//IMPORTAMOS EL SERVICIO
import { ActividadesService } from 'src/app/services/actividades.service';

@Component({
  selector: 'app-lista-evento-voluntario',
  templateUrl: './lista-evento-voluntario.component.html',
  styleUrls: ['./lista-evento-voluntario.component.css']
})
export class ListaEventoVoluntarioComponent {
  
  public fecha_inicio: string = "15-04-2023";
  public fecha_fin: string = "16-04-2023";
  public hora_inicio : string = "08:30:00";
  public hora_fin : string = "---";
  public maximo_voluntarios: number = 30;
  public contador_voluntarios: number = 15;
  public lugar_evento: string = "C/ Miguel Perez 82";
  public descripcion_evento: string = "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum."
  public titulo_evento: string = "Título Evento";

  public isDisabled: boolean = false;
  public unido: boolean = false;

  //CREAMOS EL CONSTRUCTOR PARA ALBERGAR EL SERVICIO
  public constructor (public service: ActividadesService){}

  ngOnInit(){
    //LLAMAMOS AL INICIAR LA VISTA A LA FUNCION QUE RECOGE EL LISTADO
    this.getEventos();
    if(this.contador_voluntarios >= this.maximo_voluntarios){
      this.isDisabled = true;
    }
  }


  public getEventos():void{
    this.service.getActividades().subscribe(response => {
      console.log(response)
    })
  }

  public unirse() {
 
    this.contador_voluntarios ++;
    this.unido = true;
    if(this.contador_voluntarios >= this.maximo_voluntarios){
      this.isDisabled = true;
    }

  }

  public desunirse() {
 
    this.contador_voluntarios --;
    this.unido = false;
    if(this.contador_voluntarios >= this.maximo_voluntarios){
      this.isDisabled = true;
    }

  }

}
