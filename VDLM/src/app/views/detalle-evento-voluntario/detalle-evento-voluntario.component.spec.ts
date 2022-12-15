import { ComponentFixture, TestBed } from '@angular/core/testing';

import { DetalleEventoVoluntarioComponent } from './detalle-evento-voluntario.component';

describe('DetalleEventoVoluntarioComponent', () => {
  let component: DetalleEventoVoluntarioComponent;
  let fixture: ComponentFixture<DetalleEventoVoluntarioComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      declarations: [ DetalleEventoVoluntarioComponent ]
    })
    .compileComponents();

    fixture = TestBed.createComponent(DetalleEventoVoluntarioComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
