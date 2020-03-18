import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { GoogleComponent } from './google.component';
import { AuthService } from "../../../../services/auth/auth.service";
import { SocialLoginService } from "../../../../services/auth/social-login.service";
import { LoginService } from "../../../../services/auth/login.service";
import { AuthServiceConfig } from "angularx-social-login";
import { HttpClientTestingModule } from "@angular/common/http/testing";

describe('GoogleComponent', () => {
  let component: GoogleComponent;
  let fixture: ComponentFixture<GoogleComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ GoogleComponent ],
      providers: [
        AuthService,
        SocialLoginService,
        LoginService,
        AuthServiceConfig
      ],
      imports: [
        HttpClientTestingModule
      ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(GoogleComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  // it('should create', () => {
  //   expect(component).toBeTruthy();
  // }); //todo add test
});
