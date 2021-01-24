import { Component, OnInit } from '@angular/core';
import { ActivatedRoute, Router} from '@angular/router';
import { FormBuilder, FormGroup } from '@angular/forms';
import { AuthService } from '../../../services/auth/auth.service';
import { AuthValidator } from '../../../validators/auth-validator';
import { AbstractFormComponent } from 'src/app/abstract/abstract-form.component';

@Component({
  selector: 'app-response-password-reset',
  templateUrl: './response-password-reset.component.html',
  styleUrls: ['./response-password-reset.component.scss']
})
export class ResponsePasswordResetComponent extends AbstractFormComponent implements OnInit {

  private token: string;
  public validator: AuthValidator = new AuthValidator();

  constructor(
      private _FormBuilder: FormBuilder,
      private _Auth: AuthService,
      private _Route: ActivatedRoute,
  ) {
    super();
  }

  ngOnInit() {
    this._Route.queryParams.subscribe(params => {
      this.token= params.token;
    });

    this.form = this._FormBuilder.group({
      email: this.validator.rules.email,
      password: this.validator.rules.password,
      password_confirmation: this.validator.rules.passwordConfirmation,
    });
  }

  onSubmit() {
    this.message = '';
    if (this.validator.handleFrontend(this.f)) {
      this._Auth.changePassword({
        email: this.f.email.value,
        password: this.f.password.value,
        password_confirmation: this.f.password_confirmation.value,
        token: this.token
      }).subscribe(
          data => this.handleResponse(data),
          error =>  this.validator.handleBackend(error.error.error),
      );
    }
  }

  handleResponse(response) {
    this.message = response.message;
  }
}
