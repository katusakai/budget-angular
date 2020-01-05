import { Injectable } from '@angular/core';
import { environment } from "../../../environments/environment";
import { HttpClient } from '@angular/common/http';
import { HeadersService } from './headers.service';
import { BehaviorSubject } from "rxjs";
import { TokenService } from "./token.service";

@Injectable({
  providedIn: 'root'
})
export class AuthService {

  private loggedIn = new BehaviorSubject<boolean>(this.Token.loggedIn());
  authStatus = this.loggedIn.asObservable();

  constructor(
      private http: HttpClient,
      private header: HeadersService,
      private Token: TokenService,
  ) { }

  login(data) {
    return this.http.post(`${environment.backendUri}/auth/login`, data);
  }

  getCurrentUser() {
    return this.http.get(`${environment.backendUri}/user`, this.header.get());
  }

  changeAuthStatus(value: boolean) {
    this.loggedIn.next(value);
  }
}
