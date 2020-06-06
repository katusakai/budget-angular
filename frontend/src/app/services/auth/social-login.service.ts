import { Injectable } from '@angular/core';
import { AuthService, FacebookLoginProvider, GoogleLoginProvider } from 'angularx-social-login';

@Injectable({
  providedIn: 'root'
})
export class SocialLoginService {

  constructor(
      private _AuthService: AuthService
  ) { }

  signInWithGoogle() {
    return this._AuthService.signIn(GoogleLoginProvider.PROVIDER_ID);
  }

  signInWithFacebook() {
    return this._AuthService.signIn(FacebookLoginProvider.PROVIDER_ID);
  }

  signOut(): void {
    this._AuthService.signOut();
  }
}
