import { Injectable } from '@angular/core';
import { HttpHeaders } from '@angular/common/http';
import {TokenService} from './token.service';

@Injectable({
  providedIn: 'root'
})
export class HeadersService {

  private apiToken: string;

  constructor(private token: TokenService) {
    this.setApiToken();
  }

  get() {
    return {headers:
          new HttpHeaders({
            Authorization: `Bearer ${this.apiToken}`,
            Accept: 'application/json'
          })
    };
  }

  setApiToken() {
    this.apiToken = this.token.get();
  }
}
