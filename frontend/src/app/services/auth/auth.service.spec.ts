import { TestBed } from '@angular/core/testing';

import { AuthService } from './auth.service';
import { TokenService } from "./token.service";
import { HttpClientTestingModule } from "@angular/common/http/testing";

describe('AuthService', () => {
  beforeEach(() => TestBed.configureTestingModule({
    providers: [
      TokenService,
    ],
    imports: [
      HttpClientTestingModule
    ]
  }));

  it('should be created', () => {
    const service: AuthService = TestBed.get(AuthService);
    expect(service).toBeTruthy();
  });
});
