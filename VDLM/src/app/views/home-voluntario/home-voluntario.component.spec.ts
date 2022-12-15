import { ComponentFixture, TestBed } from '@angular/core/testing';

import { HomeVoluntarioComponent } from './home-voluntario.component';

describe('HomeVoluntarioComponent', () => {
  let component: HomeVoluntarioComponent;
  let fixture: ComponentFixture<HomeVoluntarioComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      declarations: [ HomeVoluntarioComponent ]
    })
    .compileComponents();

    fixture = TestBed.createComponent(HomeVoluntarioComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
