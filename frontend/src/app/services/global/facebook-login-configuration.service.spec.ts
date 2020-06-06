import { TestBed } from '@angular/core/testing';

import { FacebookLoginConfigurationService } from './facebook-login-configuration.service';
import { HttpClientTestingModule } from "@angular/common/http/testing";

describe('FacebookLoginConfigurationService', () => {
  let service: FacebookLoginConfigurationService;

  beforeEach(() => {
    TestBed.configureTestingModule({
      imports: [
        HttpClientTestingModule
      ]
    });
    service = TestBed.inject(FacebookLoginConfigurationService);
  });

  it('should be created', () => {
    expect(service).toBeTruthy();
  });
});
