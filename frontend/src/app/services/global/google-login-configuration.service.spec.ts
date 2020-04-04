import { TestBed } from '@angular/core/testing';

import { GoogleLoginConfigurationService } from './google-login-configuration.service';
import { HttpClientTestingModule } from "@angular/common/http/testing";

describe('GoogleLoginConfigurationService', () => {
  let service: GoogleLoginConfigurationService;

  beforeEach(() => {
    TestBed.configureTestingModule({
      imports: [
        HttpClientTestingModule
      ]
    });
    service = TestBed.inject(GoogleLoginConfigurationService);
  });

  it('should be created', () => {
    expect(service).toBeTruthy();
  });
});
