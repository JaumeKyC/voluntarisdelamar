import { ComponentFixture, TestBed } from '@angular/core/testing';

import { DetalleVoluntariosComponent } from './detalle-voluntarios.component';

describe('DetalleVoluntariosComponent', () => {
  let component: DetalleVoluntariosComponent;
  let fixture: ComponentFixture<DetalleVoluntariosComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      declarations: [ DetalleVoluntariosComponent ]
    })
    .compileComponents();

    fixture = TestBed.createComponent(DetalleVoluntariosComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
