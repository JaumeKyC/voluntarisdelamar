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

  //ARRAY QUE RECOGE LOS DATOS SACADOS DE LA API CON EL MODELO DE NUESTRA INTERFAZ
  // public resp: Actividades = { data: [
  //   { ID: 0, ES_FORMACION: false, 
  //   NOMBRE: '', FECHA_INICIO: new Date(), HORA_INICIO: new Date(), UBICACION: '', ENTIDAD_ORGANIZADORA: '', 
  //   NUM_EMBARCACIONES: 0, NUM_MOTOS: 0, NUM_PATRONES: 0, 
  //   NUM_TRIPULANTES: 0, NUM_SOCORRISTAS: 0, OBSERVACIONES: '', VOLUNTARIOS: 0, MAX_VOLUNTARIOS: 0, USER_JOINED: false},
    
  // ]};

  public resp: Actividades[] = [];


  public isDisabled: boolean = false;
  public unido: boolean = false;

  //CREAMOS EL CONSTRUCTOR PARA ALBERGAR EL SERVICIO
  public constructor (public service: ActividadesService){}

  ngOnInit(){
    //LLAMAMOS AL INICIAR LA VISTA A LA FUNCION QUE RECOGE EL LISTADO
    if(this.contador_voluntarios >= this.maximo_voluntarios){
      this.isDisabled = true;
    }
  }

  public getListadoEventos(){
    this.service.getActividades(4).subscribe((response: any) => {
      this.resp.push(response)
      console.log(this.resp[0].ID);
    })
  }


  public unirse(id: number) {
 
    this.contador_voluntarios ++;
    this.unido = true;
    if(this.contador_voluntarios >= this.maximo_voluntarios){
      this.isDisabled = true;
    }

  }

  public desunirse(id: number) {
 
    this.contador_voluntarios --;
    this.unido = false;
    if(this.contador_voluntarios >= this.maximo_voluntarios){
      this.isDisabled = true;
    }

  }

}
