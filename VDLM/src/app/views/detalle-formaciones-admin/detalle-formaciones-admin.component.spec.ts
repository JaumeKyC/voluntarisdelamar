import { ComponentFixture, TestBed } from '@angular/core/testing';

import { DetalleFormacionesAdminComponent } from './detalle-formaciones-admin.component';

describe('DetalleFormacionesAdminComponent', () => {
  let component: DetalleFormacionesAdminComponent;
  let fixture: ComponentFixture<DetalleFormacionesAdminComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      declarations: [ DetalleFormacionesAdminComponent ]
    })
    .compileComponents();

    fixture = TestBed.createComponent(DetalleFormacionesAdminComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
