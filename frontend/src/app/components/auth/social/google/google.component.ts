import { Component, OnInit } from '@angular/core';
import { AuthService } from '../../../../services/auth/auth.service';
import { SocialLoginService } from '../../../../services/auth/social-login.service';
import { LoginService } from '../../../../services/auth/login.service';
import { Response } from '../../../../models/response';

@Component({
  selector: 'app-google',
  templateUrl: './google.component.html',
  styleUrls: ['./google.component.scss']
})
export class GoogleComponent implements OnInit {

  private response: Response;

  constructor(
      private Auth: AuthService,
      private SocialLogin: SocialLoginService,
      private Login: LoginService,

  ) { }

  ngOnInit() {
  }

  submit() {
    this.SocialLogin.signInWithGoogle().then((user) => {
      this.Auth.googleLogin(user).subscribe(
          data => {
            this.response = data as Response;
            if (this.response.success) {
              this.Login.handleResponse(data, '/');
            }
          },
          error => console.log(error)
      );
    });
  }

}
