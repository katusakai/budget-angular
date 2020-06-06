import { TestBed } from '@angular/core/testing';

import { CanRegisterGuard } from './can-register.guard';
import { HttpClientTestingModule } from "@angular/common/http/testing";

describe('CanRegisterGuard', () => {
  let guard: CanRegisterGuard;

  beforeEach(() => {
    TestBed.configureTestingModule({
      imports: [
        HttpClientTestingModule
      ]
    });
    guard = TestBed.inject(CanRegisterGuard);
  });

  it('should be created', () => {
    expect(guard).toBeTruthy();
  });
});
