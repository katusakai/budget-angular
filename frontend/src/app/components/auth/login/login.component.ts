import { Component, OnInit } from '@angular/core';
import { FormBuilder, FormGroup, Validators } from '@angular/forms';
import { AuthService } from '../../../services/auth/auth.service';
import { LoginService } from "../../../services/auth/login.service";
import { ValidatorService } from "../../../services/auth/validator.service";

@Component({
  selector: 'app-login',
  templateUrl: './login.component.html',
  styleUrls: ['./login.component.scss']
})
export class LoginComponent implements OnInit {

  public form:FormGroup;

  public backendError = null;
  public frontendError = {
    email: [],
    password: [],
  };

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
    })
  }

  get f() { return this.form.controls; }

  onSubmit() {
    if (this.handleFrontEndError()) {
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

  handleFrontEndError() {
    this.frontendError.email = [];
    this.frontendError.password = [];

    if (this.f.email.errors) {
      if (this.f.email.errors.required) {
        this.frontendError.email.push('Email is required');
      }
      if (this.f.email.errors.email) {
        this.frontendError.email.push('Not an email');
      }
      if (this.f.email.errors.max) {
        this.frontendError.email.push('Email is too long');
      }

    }

    if (this.f.password.errors) {
      if (this.f.password.errors.required) {
        this.frontendError.password.push('Password is required');
      }
      if (this.f.password.errors.minlength) {
        this.frontendError.password.push('Password is too short');
      }
    }

    return !(this.frontendError.email.length || this.frontendError.password.length);
  }

}
