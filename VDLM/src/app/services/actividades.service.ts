import { Injectable } from '@angular/core';
//IMPORTAMOS LOS SERVICIOS
import { Observable } from 'rxjs';
import { HttpClient } from '@angular/common/http';

//IMPORTAMOS LAS INTERFACES
import { Actividades } from '../models/actividades';

@Injectable({
  providedIn: 'root'
})
export class ActividadesService {

  constructor(public http: HttpClient) { }

  public listado_actividades = "http://localhost:8000/api/listActividades/";

  public getActividades(id: number):Observable<any>{
    return this.http.get<Actividades>(this.listado_actividades + `${id}`);
  }

}
