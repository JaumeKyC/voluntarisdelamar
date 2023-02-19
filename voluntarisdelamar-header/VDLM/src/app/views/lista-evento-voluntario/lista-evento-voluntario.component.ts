import { Component } from '@angular/core';
//IMPORTAMOS EL SERVICIO
import { ActividadesService } from 'src/app/services/actividades.service';

//IMPORTAMOS LAS INTERFACES
import { Actividades } from 'src/app/models/actividades';

@Component({
  selector: 'app-lista-evento-voluntario',
  templateUrl: './lista-evento-voluntario.component.html',
  styleUrls: ['./lista-evento-voluntario.component.css']
})
export class ListaEventoVoluntarioComponent {

  public maximo_voluntarios: number = 30;
  public contador_voluntarios: number = 15;

  public resp: Actividades[] = [];


  public isDisabled: boolean = false;
  public unido: boolean = false;
  public id: any = sessionStorage.getItem('id');

  //CREAMOS EL CONSTRUCTOR PARA ALBERGAR EL SERVICIO
  public constructor(public service: ActividadesService) { }

  ngOnInit() {
    this.getListadoEventos();
    //LLAMAMOS AL INICIAR LA VISTA A LA FUNCION QUE RECOGE EL LISTADO
    if (this.contador_voluntarios >= this.maximo_voluntarios) {
      this.isDisabled = true;
    }

  }

  public detalle(idEvento: number) {

    this.service.getActividades(this.id).subscribe((response: any[]) => {
        this.resp = response[idEvento];
        /* console.log(this.resp[0]); */
      localStorage.setItem('nombre_evento', this.resp[0].NOMBRE);
      localStorage.setItem('descripcion_evento', this.resp[0].OBSERVACIONES);
      localStorage.setItem('fecha_inicio_evento', this.resp[0].FECHA_INICIO);
      localStorage.setItem('hora_inicio_evento', this.resp[0].HORA_INICIO);
      localStorage.setItem('voluntarios_evento', this.resp[0].VOLUNTARIOS);
      localStorage.setItem('max_voluntarios_evento', this.resp[0].MAX_VOLUNTARIOS);
    })
  }

  public getListadoEventos() {

    this.service.getActividades(this.id).subscribe((response: any[]) => {

      for (let i = 0; i < response.length; i++) {
        if (response[i].ES_FORMACION != true) {
          this.resp = response;

        }
      }
    })
  }


  public unirse(id: number) {

    this.contador_voluntarios++;
    this.unido = true;
    if (this.contador_voluntarios >= this.maximo_voluntarios) {
      this.isDisabled = true;
    }

  }

  public desunirse(id: number) {

    this.contador_voluntarios--;
    this.unido = false;
    if (this.contador_voluntarios >= this.maximo_voluntarios) {
      this.isDisabled = true;
    }

  }

}
