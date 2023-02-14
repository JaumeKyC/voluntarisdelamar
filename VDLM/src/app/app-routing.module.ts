import { NgModule } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';
import { DetalleVoluntariosComponent } from './views/detalle-voluntarios/detalle-voluntarios.component';

const routes: Routes = [
  { path: 'detalle-voluntarios/:id', component: DetalleVoluntariosComponent }
];


@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
})
export class AppRoutingModule { }
