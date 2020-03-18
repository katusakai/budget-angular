import { TestBed } from '@angular/core/testing';

import { RolesService } from './roles.service';
import { AuthService } from "./auth.service";
import { RolesEventService } from "../../events/roles-event.service";
import { HttpClientTestingModule } from "@angular/common/http/testing";

describe('RolesService', () => {
  let service: RolesService;

  beforeEach(() => {
    TestBed.configureTestingModule({
      providers: [
        AuthService,
        RolesEventService,
      ],
      imports: [
        HttpClientTestingModule
      ]
    });
    service = TestBed.inject(RolesService);
  });

  it('should be created', () => {
    expect(service).toBeTruthy();
  });
});
