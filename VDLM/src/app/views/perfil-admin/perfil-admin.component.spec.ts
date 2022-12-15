import { ComponentFixture, TestBed } from '@angular/core/testing';

import { PerfilAdminComponent } from './perfil-admin.component';

describe('PerfilAdminComponent', () => {
  let component: PerfilAdminComponent;
  let fixture: ComponentFixture<PerfilAdminComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      declarations: [ PerfilAdminComponent ]
    })
    .compileComponents();

    fixture = TestBed.createComponent(PerfilAdminComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
