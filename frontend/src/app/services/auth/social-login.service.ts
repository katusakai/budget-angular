import { Injectable } from '@angular/core';
import { SocialAuthService, FacebookLoginProvider, GoogleLoginProvider } from 'angularx-social-login';

@Injectable({
  providedIn: 'root'
})
export class SocialLoginService {

  constructor(
      private _SocialAuthService: SocialAuthService
  ) { }

  signInWithGoogle() {
    return this._SocialAuthService.signIn(GoogleLoginProvider.PROVIDER_ID);
  }

  signInWithFacebook() {
    return this._SocialAuthService.signIn(FacebookLoginProvider.PROVIDER_ID);
  }

  signOut(): void {
    this._SocialAuthService.signOut();
  }
}
