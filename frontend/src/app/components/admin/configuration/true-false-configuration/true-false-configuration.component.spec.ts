import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { TrueFalseConfigurationComponent } from './true-false-configuration.component';

describe('TrueFalseConfigurationComponent', () => {
  let component: TrueFalseConfigurationComponent;
  let fixture: ComponentFixture<TrueFalseConfigurationComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ TrueFalseConfigurationComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(TrueFalseConfigurationComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
