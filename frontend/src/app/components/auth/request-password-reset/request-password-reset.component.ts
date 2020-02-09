import { Component, OnInit } from '@angular/core';
import { AuthService } from "../../../services/auth/auth.service";
import { FormBuilder, FormGroup } from "@angular/forms";
import { AuthErrors } from "../../../models/errors/AuthErrors";
import { ValidatorService } from "../../../services/auth/validator.service";

@Component({
  selector: 'app-request-password-reset',
  templateUrl: './request-password-reset.component.html',
  styleUrls: ['./request-password-reset.component.scss']
})
export class RequestPasswordResetComponent implements OnInit {

  public form: FormGroup;
  public errors: AuthErrors;
  public message: string;

  constructor(
      private formBuilder: FormBuilder,
      private Auth: AuthService,
      private Validator: ValidatorService,
  ) { }

  ngOnInit() {
    this.form = this.formBuilder.group({
      email: this.Validator.email,
    });
    this.errors = new AuthErrors();
  }

  get f() { return this.form.controls; }

  onSubmit() {
    this.message = '';
    if (this.errors.handleFrontend(this.f)) {
      this.Auth.sendPasswordResetLink({
        email: this.f.email.value,
      }).subscribe(
          data => {
            this.handleResponse(data);
          },
          error => this.errors.handleBackend(error.error.error),
      )
    }
  }

  handleResponse(response) {
    this.message = response.message;
  }

}
