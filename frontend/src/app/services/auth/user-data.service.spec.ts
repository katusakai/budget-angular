import { TestBed } from '@angular/core/testing';

import { UserDataService } from './user-data.service';
import { AuthService } from "./auth.service";
import { RolesService } from "./roles.service";
import { HttpClientTestingModule } from "@angular/common/http/testing";

describe('UserDataService', () => {
  let service: UserDataService;

  beforeEach(() => {
    TestBed.configureTestingModule({
      providers: [
        AuthService,
        RolesService,
      ],
      imports: [
        HttpClientTestingModule
      ]
    });
    service = TestBed.inject(UserDataService);
  });

  it('should be created', () => {
    expect(service).toBeTruthy();
  });
});
