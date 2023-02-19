import { ComponentFixture, TestBed } from '@angular/core/testing';

import { DetalleFormacionesVoluntarioComponent } from './detalle-formaciones-voluntario.component';

describe('DetalleFormacionesVoluntarioComponent', () => {
  let component: DetalleFormacionesVoluntarioComponent;
  let fixture: ComponentFixture<DetalleFormacionesVoluntarioComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      declarations: [ DetalleFormacionesVoluntarioComponent ]
    })
    .compileComponents();

    fixture = TestBed.createComponent(DetalleFormacionesVoluntarioComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
