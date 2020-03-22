import { TestBed } from '@angular/core/testing';

import { GoogleLoginConfigurationService } from './google-login-configuration.service';

describe('GoogleLoginConfigurationService', () => {
  let service: GoogleLoginConfigurationService;

  beforeEach(() => {
    TestBed.configureTestingModule({});
    service = TestBed.inject(GoogleLoginConfigurationService);
  });

  it('should be created', () => {
    expect(service).toBeTruthy();
  });
});
