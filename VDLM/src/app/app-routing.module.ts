import { NgModule } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';

import { LoginComponent } from './views/login/login.component';
import { HomeAdminComponent } from './views/home-admin/home-admin.component';
import { HomeVoluntarioComponent } from './views/home-voluntario/home-voluntario.component';
import { ListaEventoAdminComponent } from './views/lista-evento-admin/lista-evento-admin.component';
import { ListaEventoVoluntarioComponent } from './views/lista-evento-voluntario/lista-evento-voluntario.component';
import { ListaFormacionesAdminComponent } from './views/lista-formaciones-admin/lista-formaciones-admin.component';
import { ListaFormacionesVoluntarioComponent } from './views/lista-formaciones-voluntario/lista-formaciones-voluntario.component';
import { DetalleEventoAdminComponent } from './views/detalle-evento-admin/detalle-evento-admin.component';
import { DetalleEventoVoluntarioComponent } from './views/detalle-evento-voluntario/detalle-evento-voluntario.component';
import { DetalleFormacionesAdminComponent } from './views/detalle-formaciones-admin/detalle-formaciones-admin.component';
import { DetalleFormacionesVoluntarioComponent } from './views/detalle-formaciones-voluntario/detalle-formaciones-voluntario.component';
import { PerfilAdminComponent } from './views/perfil-admin/perfil-admin.component';
import { PerfilVoluntarioComponent } from './views/perfil-voluntario/perfil-voluntario.component';

const routes: Routes = [
  { path: '', redirectTo: 'homeVoluntaris', pathMatch: 'full' },
  { path: 'home_voluntaris', component: HomeVoluntarioComponent },
  { path: 'listado_eventos_admin', component: ListaEventoAdminComponent },
  { path: 'listadoEventosVoluntari', component: ListaEventoVoluntarioComponent },
  { path: 'listadoFormacionesAdmin', component: ListaFormacionesAdminComponent },
  { path: 'listadoFormacionesVoluntari', component: ListaFormacionesVoluntarioComponent },
  { path: 'perfil_usuario', component: PerfilVoluntarioComponent },
  { path: 'login', component: LoginComponent },

  
  ];

@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
})
export class AppRoutingModule { }
