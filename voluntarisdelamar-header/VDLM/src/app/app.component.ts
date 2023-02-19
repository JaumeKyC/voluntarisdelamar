import { Component } from '@angular/core';
import { Router } from '@angular/router';

@Component({
  selector: 'app-root',
  templateUrl: './app.component.html',
  styleUrls: ['./app.component.css']
})
export class AppComponent {
  title = 'VDLM';
  public loggeado: boolean = false;


  public sesion(log:boolean){
    this.loggeado = log;
  }

  public logOut(log:boolean){
    this.loggeado = log;
  }

  public ngOnChange(){
    if(sessionStorage.getItem('id') !== null){
      this.loggeado = true;
  }else{
      this.loggeado = false;
  }
  console.log(sessionStorage.getItem('id'));
  }
  

  }


