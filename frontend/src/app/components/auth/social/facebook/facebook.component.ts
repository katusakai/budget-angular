import { Component, OnInit } from '@angular/core';
import { Response } from "../../../../models/response";
import { AuthService } from "../../../../services/auth/auth.service";
import { SocialLoginService } from "../../../../services/auth/social-login.service";
import { LoginService } from "../../../../services/auth/login.service";
import { FacebookLoginConfigurationService } from "../../../../services/global/facebook-login-configuration.service";

@Component({
  selector: 'app-facebook',
  templateUrl: './facebook.component.html',
  styleUrls: ['./facebook.component.scss']
})
export class FacebookComponent implements OnInit {

  private response: Response;

  constructor(
    private Auth: AuthService,
    private SocialLogin: SocialLoginService,
    private Login: LoginService,
    public FacebooConfig: FacebookLoginConfigurationService
  ) { }

  ngOnInit(): void {
  }

  submit() {
    this.SocialLogin.signInWithFacebook().then((user) => {
      console.log(user);
      // this.Auth.googleLogin(user).subscribe(
      //   data => {
      //     this.response = data as Response;
      //     if (this.response.success) {
      //       this.Login.handleResponse(data, '/');
      //     }
      //   },
      //   error => {
      //     if (error.status === 403) {
      //       // this.check();
      //     }
      //   }
      // );
    });
  }

  check() {
    this. FacebooConfig.setAccess();
  }

}
