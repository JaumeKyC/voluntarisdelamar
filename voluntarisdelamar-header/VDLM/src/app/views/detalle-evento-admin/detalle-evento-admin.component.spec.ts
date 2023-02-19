import { ComponentFixture, TestBed } from '@angular/core/testing';

import { DetalleEventoAdminComponent } from './detalle-evento-admin.component';

describe('DetalleEventoAdminComponent', () => {
  let component: DetalleEventoAdminComponent;
  let fixture: ComponentFixture<DetalleEventoAdminComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      declarations: [ DetalleEventoAdminComponent ]
    })
    .compileComponents();

    fixture = TestBed.createComponent(DetalleEventoAdminComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
