import { Component } from '@angular/core';
import { DataService } from 'src/app/services/data.service';
@Component({
  selector: 'app-perfil-voluntario',
  templateUrl: './perfil-voluntario.component.html',
  styleUrls: ['./perfil-voluntario.component.css']
})
export class PerfilVoluntarioComponent {
  public constructor(public service: DataService) { }
  public id: any = sessionStorage.getItem('id');
  public nombreCompleto: string = "";
  public dni: string = "";
  public email: string = "";
  public movil: string = "";
  public provincia: string = "";
  public codigoPostal: string = "";
  public poblacion: string = "";
  public direccion: string = "";
  public fechaNacimiento: Date = new Date; //Podria ser date?
  public titulaciones: string = "";
  public case: number = 0;
  public isDisabled = true;
  public contrasena: string = "";
  /* public i: number = 0; */


  public onClick() {
    this.isDisabled = !this.isDisabled;
    if (this.isDisabled == false) {
      this.case = 1;
    } else {
      this.case = 0;
    }
  }

  public onSubmit() {

  }
  
  public ngOnInit(): void{
    this.getUser();
  }

 
  public getUser(): void {
   /*  console.log(sessionStorage.getItem('id')); */
    
    this.service.getUser(this.id).subscribe(response => {
      this.dni = response.DNI;
      this.nombreCompleto = response.NOMBRE +' '+response.APELLIDOS;
      this.email = response.EMAIL;
      this.movil = response.TELEFONO;
      this.provincia = response.PROVINCIA;
      this.codigoPostal = response.COD_POSTAL;
      this.poblacion = response.POBLACION;
      this.direccion = response.DIRECCION;
      this.fechaNacimiento = response.FECHA_NACIMIENTO;
      this.titulaciones = response.TITULACIONES;

    })

  }






}
