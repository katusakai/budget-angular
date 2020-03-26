import { TestBed } from '@angular/core/testing';

import { CanRegisterConfigurationService } from './can-register-configuration.service';

describe('CanRegisterConfigurationService', () => {
  let service: CanRegisterConfigurationService;

  beforeEach(() => {
    TestBed.configureTestingModule({});
    service = TestBed.inject(CanRegisterConfigurationService);
  });

  it('should be created', () => {
    expect(service).toBeTruthy();
  });
});
