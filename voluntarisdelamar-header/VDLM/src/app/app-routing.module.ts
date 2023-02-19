import { NgModule } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';

import { LoginComponent } from './views/login/login.component';
import { HomeVoluntarioComponent } from './views/home-voluntario/home-voluntario.component';
import { ListaEventoVoluntarioComponent } from './views/lista-evento-voluntario/lista-evento-voluntario.component';
import { ListaFormacionesVoluntarioComponent } from './views/lista-formaciones-voluntario/lista-formaciones-voluntario.component';
import { DetalleEventoVoluntarioComponent } from './views/detalle-evento-voluntario/detalle-evento-voluntario.component';
import { DetalleFormacionesVoluntarioComponent } from './views/detalle-formaciones-voluntario/detalle-formaciones-voluntario.component';
import { PerfilVoluntarioComponent } from './views/perfil-voluntario/perfil-voluntario.component';

const routes: Routes = [
  { path: '', redirectTo: 'login', pathMatch: 'full' },
  { path: 'home_voluntaris', component: HomeVoluntarioComponent },
  { path: 'listado_eventos', component: ListaEventoVoluntarioComponent },
  { path: 'detalle_eventos/:id', component: DetalleEventoVoluntarioComponent },
  { path: 'listado_formaciones', component: ListaFormacionesVoluntarioComponent },
  { path: 'detalle_formaciones/:id', component: DetalleFormacionesVoluntarioComponent },
  { path: 'perfil_usuario', component: PerfilVoluntarioComponent },
  { path: 'login', component: LoginComponent },
  ];

@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
})
export class AppRoutingModule { }
