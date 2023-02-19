import { NgModule } from '@angular/core';
import { BrowserModule } from '@angular/platform-browser';
import { HttpClientModule } from '@angular/common/http';
import { FormsModule } from '@angular/forms';

import { AppRoutingModule } from './app-routing.module';
import { AppComponent } from './app.component';
import { HeaderComponent } from './components/header/header.component';
import { LoginComponent } from './views/login/login.component';
import { HomeAdminComponent } from './views/home-admin/home-admin.component';
import { HomeVoluntarioComponent } from './views/home-voluntario/home-voluntario.component';
import { ListaEventoAdminComponent } from './views/lista-evento-admin/lista-evento-admin.component';
import { ListaEventoVoluntarioComponent } from './views/lista-evento-voluntario/lista-evento-voluntario.component';
import { DetalleEventoAdminComponent } from './views/detalle-evento-admin/detalle-evento-admin.component';
import { DetalleEventoVoluntarioComponent } from './views/detalle-evento-voluntario/detalle-evento-voluntario.component';
import { ListaFormacionesAdminComponent } from './views/lista-formaciones-admin/lista-formaciones-admin.component';
import { ListaFormacionesVoluntarioComponent } from './views/lista-formaciones-voluntario/lista-formaciones-voluntario.component';
import { DetalleFormacionesAdminComponent } from './views/detalle-formaciones-admin/detalle-formaciones-admin.component';
import { DetalleFormacionesVoluntarioComponent } from './views/detalle-formaciones-voluntario/detalle-formaciones-voluntario.component';
import { FormularioAltaComponent } from './views/formulario-alta/formulario-alta.component';
import { PerfilAdminComponent } from './views/perfil-admin/perfil-admin.component';
import { PerfilVoluntarioComponent } from './views/perfil-voluntario/perfil-voluntario.component';

@NgModule({
  declarations: [
    AppComponent,
    HeaderComponent,
    LoginComponent,
    HomeAdminComponent,
    HomeVoluntarioComponent,
    ListaEventoAdminComponent,
    ListaEventoVoluntarioComponent,
    DetalleEventoAdminComponent,
    DetalleEventoVoluntarioComponent,
    ListaFormacionesAdminComponent,
    ListaFormacionesVoluntarioComponent,
    DetalleFormacionesAdminComponent,
    DetalleFormacionesVoluntarioComponent,
    FormularioAltaComponent,
    PerfilAdminComponent,
    PerfilVoluntarioComponent
  ],
  imports: [
    BrowserModule,
    AppRoutingModule,
    HttpClientModule,
    FormsModule
  ],
  providers: [],
  bootstrap: [AppComponent]
})
export class AppModule { }
