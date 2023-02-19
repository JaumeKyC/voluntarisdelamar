import { Component } from '@angular/core';
import { ActividadesService } from 'src/app/services/actividades.service';
import { Actividades } from 'src/app/models/actividades';
@Component({
  selector: 'app-lista-formaciones-voluntario',
  templateUrl: './lista-formaciones-voluntario.component.html',
  styleUrls: ['./lista-formaciones-voluntario.component.css']
})
export class ListaFormacionesVoluntarioComponent {
  
  public resp: Actividades[] = [];

  public maximo_voluntarios: number = 30;
  public contador_voluntarios: number = 15;
  public isDisabled: boolean = false;
  public unido: boolean = false;
  public id: any = sessionStorage.getItem('id');
  public constructor (public service: ActividadesService){}


  ngOnInit(){
    this.getListadoFormaciones();
    if(this.contador_voluntarios >= this.maximo_voluntarios){
      this.isDisabled = true;
    }
  }

  public getListadoFormaciones(){
   
    this.service.getActividades(this.id).subscribe((response: any[]) => {
   /*    this.resp.push(response[]) */
      this.resp = response;
      /* console.log(this.resp[this.id].ID); */
      console.log(response);
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
