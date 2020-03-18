import { TestBed } from '@angular/core/testing';

import { SocialLoginService } from './social-login.service';
import { AuthService } from "angularx-social-login";

describe('SocialLoginService', () => {
  let service: SocialLoginService;

  beforeEach(() => {
    TestBed.configureTestingModule({
      providers: [
        AuthService,
      ]
    });
    service = TestBed.inject(SocialLoginService)
  });
});
