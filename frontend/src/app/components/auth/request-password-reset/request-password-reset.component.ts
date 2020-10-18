import { Component, OnInit } from '@angular/core';
import { AuthService } from '../../../services/auth/auth.service';
import { FormBuilder, FormGroup } from '@angular/forms';
import { AuthValidator } from '../../../validators/auth-validator';

@Component({
  selector: 'app-request-password-reset',
  templateUrl: './request-password-reset.component.html',
  styleUrls: ['./request-password-reset.component.scss']
})
export class RequestPasswordResetComponent implements OnInit {

  public form: FormGroup;
  public message: string;
  public validator: AuthValidator = new AuthValidator();

  constructor(
      private formBuilder: FormBuilder,
      private Auth: AuthService,
  ) { }

  ngOnInit() {
    this.form = this.formBuilder.group({
      email: this.validator.rules.email,
    });
  }

  get f() { return this.form.controls; }

  onSubmit() {
    this.message = '';
    if (this.validator.handleFrontend(this.f)) {
      this.Auth.sendPasswordResetLink({
        email: this.f.email.value,
      }).subscribe(
          data => {
            this.handleResponse(data);
          },
          error => this.validator.handleBackend(error.error.error),
      )
    }
  }

  handleResponse(response) {
    this.message = response.message;
  }

}
