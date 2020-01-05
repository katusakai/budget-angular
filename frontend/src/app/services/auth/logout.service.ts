import { Injectable } from '@angular/core';
import { TokenService } from "./token.service";
import { Router } from "@angular/router";
import { AuthService } from "./auth.service";

@Injectable({
  providedIn: 'root'
})
export class LogoutService {

  constructor(
      private Token: TokenService,
      private Auth: AuthService,
      private router: Router,
  ) { }

  handleResponse() {
    this.Token.remove();
    this.Auth.changeAuthStatus(false);
    this.router.navigateByUrl('/login');
  }
}

