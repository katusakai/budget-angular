import { Component, OnInit } from '@angular/core';
import { AuthService } from "../../../../services/auth/auth.service";
import { AuthService as SocialAuthService } from "angularx-social-login";
import { SocialLoginService } from "../../../../services/auth/social-login.service";

@Component({
  selector: 'app-google',
  templateUrl: './google.component.html',
  styleUrls: ['./google.component.scss']
})
export class GoogleComponent implements OnInit {

  constructor(
      private Auth: AuthService,
      private SocialLogin: SocialLoginService,
      private SocialAuth: SocialAuthService
  ) { }

  ngOnInit() {
    this.SocialAuth.authState.subscribe((user) => {
      console.log(user);
    });
  }

  submit () {
    this.SocialLogin.signInWithGoogle();
  }

}
