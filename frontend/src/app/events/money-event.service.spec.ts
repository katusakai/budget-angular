import { TestBed } from '@angular/core/testing';

import { MoneyEventService } from './money-event.service';

describe('MoneyEventService', () => {
  let service: MoneyEventService;

  beforeEach(() => {
    TestBed.configureTestingModule({});
    service = TestBed.inject(MoneyEventService);
  });

  it('should be created', () => {
    expect(service).toBeTruthy();
  });
});
