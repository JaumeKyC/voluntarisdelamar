import { ComponentFixture, TestBed } from '@angular/core/testing';

import { ListaEventoAdminComponent } from './lista-evento-admin.component';

describe('ListaEventoAdminComponent', () => {
  let component: ListaEventoAdminComponent;
  let fixture: ComponentFixture<ListaEventoAdminComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      declarations: [ ListaEventoAdminComponent ]
    })
    .compileComponents();

    fixture = TestBed.createComponent(ListaEventoAdminComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
