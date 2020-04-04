import { TestBed } from '@angular/core/testing';

import { CanRegisterConfigurationService } from './can-register-configuration.service';
import { HttpClientTestingModule } from "@angular/common/http/testing";

describe('CanRegisterConfigurationService', () => {
  let service: CanRegisterConfigurationService;

  beforeEach(() => {
    TestBed.configureTestingModule({
      imports: [
        HttpClientTestingModule
      ]
    });
    service = TestBed.inject(CanRegisterConfigurationService);
  });

  it('should be created', () => {
    expect(service).toBeTruthy();
  });
});
