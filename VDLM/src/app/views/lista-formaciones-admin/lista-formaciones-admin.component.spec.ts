import { ComponentFixture, TestBed } from '@angular/core/testing';

import { ListaFormacionesAdminComponent } from './lista-formaciones-admin.component';

describe('ListaFormacionesAdminComponent', () => {
  let component: ListaFormacionesAdminComponent;
  let fixture: ComponentFixture<ListaFormacionesAdminComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      declarations: [ ListaFormacionesAdminComponent ]
    })
    .compileComponents();

    fixture = TestBed.createComponent(ListaFormacionesAdminComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
