import { Component } from '@angular/core';
import { Injectable } from '@angular/core';
import { Router } from '@angular/router';
import { Observable } from 'rxjs';

@Component({
  selector: 'app-root',
  templateUrl: './app.component.html',
  styleUrls: ['./app.component.css']
})
export class AppComponent {
  title = 'VDLM';
  loggeado: boolean = false;

  constructor (public router: Router) {

    if(this.loggeado == true && this.router.url == "/login") {
      console.log('HOLA');
      this.router.navigate(['/']);
    } 

  }

}
