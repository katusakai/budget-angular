import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { ExpansesIncomeComponent } from './expanses-income.component';

describe('ExpansesIncomeComponent', () => {
  let component: ExpansesIncomeComponent;
  let fixture: ComponentFixture<ExpansesIncomeComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ ExpansesIncomeComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(ExpansesIncomeComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
