import { Component, OnInit } from '@angular/core';
import { FormBuilder, FormGroup } from '@angular/forms';
import { AuthService } from '../../../services/auth/auth.service';
import { LoginService } from '../../../services/auth/login.service';
import { GoogleLoginConfigurationService } from '../../../services/global/google-login-configuration.service';
import { CanRegisterConfigurationService } from '../../../services/global/can-register-configuration.service';
import { FacebookLoginConfigurationService } from '../../../services/global/facebook-login-configuration.service';
import { AuthValidator } from '../../../validators/auth-validator';

@Component({
  selector: 'app-login',
  templateUrl: './login.component.html',
  styleUrls: ['./login.component.scss']
})
export class LoginComponent implements OnInit {

  public form: FormGroup;
  public validator: AuthValidator = new AuthValidator();

  constructor(
      private formBuilder: FormBuilder,
      private Auth: AuthService,
      private Login: LoginService,
      public GoogleLoginConfig: GoogleLoginConfigurationService,
      public CanRegisterConfig: CanRegisterConfigurationService,
      public FacebookLoginConfig: FacebookLoginConfigurationService
  ) { }

  ngOnInit() {
    this.form = this.formBuilder.group({
      email: this.validator.rules.email,
      password: this.validator.rules.password
    });
  }

  get f() { return this.form.controls; }

  onLogin() {
    if (this.validator.handleFrontend(this.f)) {
      this.Auth.login({
        email: this.f.email.value,
        password: this.f.password.value
      }).subscribe(
          data => {
            this.Login.handleResponse(data, '/');
          },
          error => this.validator.handleBackend(error.error.error),
      );
    }
  }
}
