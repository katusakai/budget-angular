import { TestBed } from '@angular/core/testing';

import { AdminGuard } from './admin.guard';
import { UserDataService } from "../services/auth/user-data.service";
import { HttpClientTestingModule } from "@angular/common/http/testing";

describe('AdminGuard', () => {
  let guard: AdminGuard;

  beforeEach(() => {
    TestBed.configureTestingModule({
      providers: [
        UserDataService,
      ],
      imports: [
        HttpClientTestingModule
      ]
    });
    guard = TestBed.inject(AdminGuard);
  });

  it('should be created', () => {
    expect(guard).toBeTruthy();
  });
});
