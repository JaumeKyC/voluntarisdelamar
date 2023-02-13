import { ComponentFixture, TestBed } from '@angular/core/testing';

import { DetalleAdminComponent } from './detalle-admin.component';

describe('DetalleAdminComponent', () => {
  let component: DetalleAdminComponent;
  let fixture: ComponentFixture<DetalleAdminComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      declarations: [ DetalleAdminComponent ]
    })
    .compileComponents();

    fixture = TestBed.createComponent(DetalleAdminComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
