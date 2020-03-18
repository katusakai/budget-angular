import { Component, OnInit } from '@angular/core';
import { ActivatedRoute, Router} from "@angular/router";
import { FormBuilder, FormGroup } from "@angular/forms";
import { AuthService } from "../../../services/auth/auth.service";
import { ValidatorService } from "../../../services/auth/validator.service";
import { AuthErrors } from "../../../models/errors/AuthErrors";

@Component({
  selector: 'app-response-password-reset',
  templateUrl: './response-password-reset.component.html',
  styleUrls: ['./response-password-reset.component.scss']
})
export class ResponsePasswordResetComponent implements OnInit {

  private token: string;
  public errors: AuthErrors;
  public form: FormGroup;
  public message: string;

  constructor(
      private _FormBuilder: FormBuilder,
      private _Auth: AuthService,
      private _Validator: ValidatorService,
      private _Router: Router,
      private _Route: ActivatedRoute,
  ) { }

  ngOnInit() {
    this._Route.queryParams.subscribe(params => {
      this.token= params['token'];
    });

    this.form = this._FormBuilder.group({
      email: this._Validator.email,
      password: this._Validator.password,
      password_confirmation: this._Validator.password_confirmation,
    });
    this.errors = new AuthErrors();
  }

  get f() { return this.form.controls; }

  onSubmit() {
    this.message = '';
    if (this.errors.handleFrontend(this.f)) {
      this._Auth.changePassword({
        email: this.f.email.value,
        password: this.f.password.value,
        password_confirmation: this.f.password_confirmation.value,
        token: this.token
      }).subscribe(
          data => this.handleResponse(data),
          error =>  this.errors.handleBackend(error.error.error),
      );
    }
  }

  handleResponse(response) {
    this.message = response.message;
  }
}
