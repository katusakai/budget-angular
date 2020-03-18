import { Injectable } from '@angular/core';
import { AuthService } from './auth.service';
import { TokenService } from './token.service';
import { Router } from '@angular/router';

@Injectable({
  providedIn: 'root'
})
export class LoginService {

  constructor(
      private _Auth: AuthService,
      private _Token: TokenService,
      private _Router: Router
  ) { }

  handleResponse(data, redirectUrl: string) {
    this._Token.set(data.data.token);
    this._Auth.changeAuthStatus(true);
    this._Router.navigateByUrl(redirectUrl);
  }
}
