import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { ResponsePasswordResetComponent } from './response-password-reset.component';
import { ReactiveFormsModule } from "@angular/forms";
import { AuthService } from "../../../services/auth/auth.service";
import { ValidatorService } from "../../../services/auth/validator.service";
import { RouterTestingModule } from "@angular/router/testing";
import { HttpClientTestingModule} from "@angular/common/http/testing";

describe('ResponsePasswordResetComponent', () => {
  let component: ResponsePasswordResetComponent;
  let fixture: ComponentFixture<ResponsePasswordResetComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ ResponsePasswordResetComponent ],
      providers: [
        AuthService,
        ValidatorService,
      ],
      imports: [
        RouterTestingModule,
        HttpClientTestingModule,
        ReactiveFormsModule
      ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(ResponsePasswordResetComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
