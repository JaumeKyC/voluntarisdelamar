import { ComponentFixture, TestBed } from '@angular/core/testing';

import { ListaEventoVoluntarioComponent } from './lista-evento-voluntario.component';

describe('ListaEventoVoluntarioComponent', () => {
  let component: ListaEventoVoluntarioComponent;
  let fixture: ComponentFixture<ListaEventoVoluntarioComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      declarations: [ ListaEventoVoluntarioComponent ]
    })
    .compileComponents();

    fixture = TestBed.createComponent(ListaEventoVoluntarioComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
