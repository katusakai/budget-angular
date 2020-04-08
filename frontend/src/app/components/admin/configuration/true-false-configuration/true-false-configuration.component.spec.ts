import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { TrueFalseConfigurationComponent } from './true-false-configuration.component';
import { HttpClientTestingModule } from "@angular/common/http/testing";

describe('TrueFalseConfigurationComponent', () => {
  let component: TrueFalseConfigurationComponent;
  let fixture: ComponentFixture<TrueFalseConfigurationComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ TrueFalseConfigurationComponent ],
      imports: [
        HttpClientTestingModule
      ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(TrueFalseConfigurationComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  // it('should create', () => {
  //   component.config = { name: 'name', value: 'value', id: 1};
  //   component.label = "label";
  //   expect(component).toBeTruthy();
  // });
});
