import { Injectable } from '@angular/core';
import { environment } from '../../../environments/environment';
import { HttpClient } from '@angular/common/http';
import { BehaviorSubject, Observable } from 'rxjs';
import { TokenService } from './token.service';
import { IUser } from "../../models";

@Injectable({
  providedIn: 'root'
})
export class AuthService {

  private loggedIn = new BehaviorSubject<boolean>(this.Token.loggedIn());
  status = this.loggedIn.asObservable();

  constructor(
      private http: HttpClient,
      private Token: TokenService,
  ) { }

  login(data) {
    return this.http.post(`${environment.backendUri}/auth/login`, data);
  }

  register(data) {
    return this.http.post(`${environment.backendUri}/auth/register`, data);
  }

  googleLogin(data) {
    return this.http.post(`${environment.backendUri}/auth/googleLogin`, data);
  }

  sendPasswordResetLink(data) {
    return this.http.post(`${environment.backendUri}/auth/sendPasswordResetLink`, data);
  }

  changePassword(data) {
    return this.http.post(`${environment.backendUri}/auth/resetPassword`, data);
  }

  getCurrentUser(): Observable<IUser> {
    return this.http.get<IUser>(`${environment.backendUri}/user`);
  }

  getCurrentRoles() {
    return this.http.get(`${environment.backendUri}/roles`);
  }

  changeAuthStatus(value: boolean) {
    this.loggedIn.next(value);
  }
}
