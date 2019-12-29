import { Injectable } from '@angular/core';
import { backendUri } from '../../config';
import { HttpClient } from '@angular/common/http';
import { HeadersService } from './headers.service';
import { TokenService } from './token.service';

@Injectable({
  providedIn: 'root'
})
export class AuthService {

  constructor(
      private http: HttpClient,
      private header: HeadersService,
  ) { }

  login(data) {
    return this.http.post(`${backendUri}/auth/login`, data);
  }

  getCurrentUser() {
    return this.http.get(`${backendUri}/user`, this.header.get());
  }
}
