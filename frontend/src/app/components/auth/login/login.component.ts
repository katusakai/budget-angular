import { Component, OnInit } from '@angular/core';
import { FormBuilder, FormGroup } from '@angular/forms';
import { AuthService } from '../../../services/auth/auth.service';
import { LoginService } from '../../../services/auth/login.service';
import { ValidatorService } from '../../../services/auth/validator.service';
import { FrontendError } from '../../../models/errors/frontendError';

@Component({
  selector: 'app-login',
  templateUrl: './login.component.html',
  styleUrls: ['./login.component.scss']
})
export class LoginComponent implements OnInit {

  public form: FormGroup;

  public backendError = null;

  public frontendError: FrontendError = new FrontendError();

  constructor(
      private formBuilder: FormBuilder,
      private Auth: AuthService,
      private Login: LoginService,
      private Validator: ValidatorService,
  ) { }

  ngOnInit() {
    this.form = this.formBuilder.group({
      email: this.Validator.email,
      password: this.Validator.password
    });
  }

  get f() { return this.form.controls; }

  onSubmit() {
    if (this.frontendError.handle(this.f)) {
      this.Auth.login({email: this.f.email.value, password: this.f.password.value}).subscribe(
          data => {
            this.Login.handleResponse(data, '/');
          },
          error => this.handleBackendError(error),
      );
    }
  }

  handleBackendError(error) {
    this.backendError = error.error.error;
  }

}
