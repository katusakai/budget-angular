import { TestBed } from '@angular/core/testing';

import { LogoutService } from './logout.service';
import { TokenService } from "./token.service";
import { AuthService } from "./auth.service";
import { RouterTestingModule } from "@angular/router/testing";
import { HttpClientTestingModule } from "@angular/common/http/testing";

describe('LogoutService', () => {
  let service: LogoutService;
  beforeEach(() => {
    TestBed.configureTestingModule({
      providers: [
        TokenService,
        AuthService,
      ],
      imports: [
        RouterTestingModule,
        HttpClientTestingModule
      ]
    });
    service = TestBed.inject(LogoutService);
  });

  // it('should be created', () => {
  //   expect(service).toBeTruthy();
  // });
});
