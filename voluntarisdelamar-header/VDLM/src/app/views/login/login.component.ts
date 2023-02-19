import { Component, Output, EventEmitter, Input } from '@angular/core';
import { DataService } from 'src/app/services/data.service';
import { HttpErrorResponse } from '@angular/common/http';
import { catchError, throwError } from 'rxjs';
import { Router } from '@angular/router';


@Component({
  selector: 'app-login',
  templateUrl: './login.component.html',
  styleUrls: ['./login.component.css']
})
export class LoginComponent {
  public email: string = "";
  public password: string = "";
  public status: number = 0;
  public message: string = "";
  @Output() inicioSesion = new EventEmitter<boolean>();

  constructor(public router: Router, private authService: DataService) { }

  public onSubmit(log: boolean) {
    this.authService.login(this.email, this.password).pipe(
      catchError((error) => {
        this.status = error.status;
        return throwError(() => new Error(error));
      })
    ).subscribe((response: any) => {
      this.status = response.status;
      if (this.status == 200) {

        sessionStorage.setItem('id', response.body.ID);
        
        sessionStorage.setItem('name', response.body.NOMBRE);
        
        sessionStorage.setItem('apellidos', response.body.APELLIDOS);
        this.inicioSesion.emit(log);
       this.router.navigate(['home_voluntaris']);
      }
    })
  }

/*   public onClick(){
    this.authService.getUser(3).subscribe((response: any) => {
      console.log(response);
    })
  } */

  public wrongCredentials() {
    if (this.status == 401) {
      this.message = "Usuario o contraseña incorrectos, vuelva a intentarlo."
    } return this.message;
  }


}
