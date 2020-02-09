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
      private formBuilder: FormBuilder,
      private Auth: AuthService,
      private Validator: ValidatorService,
      private router: Router,
      private route: ActivatedRoute,
  ) { }

  ngOnInit() {
    this.route.queryParams.subscribe(params => {
      this.token= params['token'];
    });

    this.form = this.formBuilder.group({
      email: this.Validator.email,
      password: this.Validator.password,
      password_confirmation: this.Validator.password_confirmation,
    });
    this.errors = new AuthErrors();
  }

  get f() { return this.form.controls; }

  onSubmit() {
    this.message = '';
    if (this.errors.handleFrontend(this.f)) {
      this.Auth.changePassword({
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
