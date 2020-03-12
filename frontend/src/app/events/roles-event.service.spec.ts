import { TestBed } from '@angular/core/testing';

import { RolesEventService } from './roles-event.service';

describe('RolesEventService', () => {
  let service: RolesEventService;

  beforeEach(() => {
    TestBed.configureTestingModule({});
    service = TestBed.inject(RolesEventService);
  });

  it('should be created', () => {
    expect(service).toBeTruthy();
  });
});
