import { Component, OnInit } from '@angular/core';
import { AuthService } from "../../../../services/auth/auth.service";
import { SocialLoginService } from "../../../../services/auth/social-login.service";
import {LoginService} from "../../../../services/auth/login.service";

@Component({
  selector: 'app-google',
  templateUrl: './google.component.html',
  styleUrls: ['./google.component.scss']
})
export class GoogleComponent implements OnInit {

  constructor(
      private Auth: AuthService,
      private SocialLogin: SocialLoginService,
      private Login: LoginService,

  ) { }

  ngOnInit() {
  }

  submit () {
    this.SocialLogin.signInWithGoogle().then((user) => {
      this.Auth.googleLogin(user).subscribe(
          data => {
            if (data.success) {
              this.Login.handleResponse(data, '/')
            }
          },
          error => console.log(error)
      );
    });
  }

}
