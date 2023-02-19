import { ComponentFixture, TestBed } from '@angular/core/testing';

import { ListaFormacionesVoluntarioComponent } from './lista-formaciones-voluntario.component';

describe('ListaFormacionesVoluntarioComponent', () => {
  let component: ListaFormacionesVoluntarioComponent;
  let fixture: ComponentFixture<ListaFormacionesVoluntarioComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      declarations: [ ListaFormacionesVoluntarioComponent ]
    })
    .compileComponents();

    fixture = TestBed.createComponent(ListaFormacionesVoluntarioComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
