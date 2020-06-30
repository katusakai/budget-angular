import { Injectable } from '@angular/core';
import { TokenService } from './token.service';
import { Router } from '@angular/router';
import { AuthService } from './auth.service';
import { SocialLoginService } from './social-login.service';
import { UserIdService } from './user-id.service';

@Injectable({
  providedIn: 'root'
})
export class LogoutService {

  constructor(
      private Token: TokenService,
      private Auth: AuthService,
      private router: Router,
      private SocialLogin: SocialLoginService,
      private _userId: UserIdService
  ) { }

  handleResponse() {
    this.Token.remove();
    this.Auth.changeAuthStatus(false);
    this.SocialLogin.signOut();
    this.router.navigateByUrl('/login');
    this._userId.remove();
  }
}

