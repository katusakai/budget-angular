import { Injectable } from '@angular/core';
import {AuthService} from "./auth.service";
import {TokenService} from "./token.service";
import {Router} from "@angular/router";

@Injectable({
  providedIn: 'root'
})
export class LoginService {

  constructor(
      private Auth: AuthService,
      private Token: TokenService,
      private router: Router
  ) { }

  handleResponse(data, redirectUrl : string) {
    this.Token.set(data.api_token);
    this.Auth.changeAuthStatus(true);
    this.router.navigateByUrl(redirectUrl);
  }
}
