import { TestBed } from '@angular/core/testing';

import { RegisterService } from './register.service';
import { AuthService } from "./auth.service";
import { TokenService } from "./token.service";
import { RouterTestingModule } from "@angular/router/testing";
import { HttpClientTestingModule } from "@angular/common/http/testing";

describe('RegisterService', () => {
  beforeEach(() => TestBed.configureTestingModule({
    providers: [
      AuthService,
      TokenService,
    ],
    imports: [
      RouterTestingModule,
      HttpClientTestingModule
    ]
  }));

  it('should be created', () => {
    const service: RegisterService = TestBed.get(RegisterService);
    expect(service).toBeTruthy();
  });
});
