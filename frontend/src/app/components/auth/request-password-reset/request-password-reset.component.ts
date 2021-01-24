import { Component, OnInit } from '@angular/core';
import { AuthService } from '../../../services/auth/auth.service';
import { FormBuilder, FormGroup } from '@angular/forms';
import { AuthValidator } from '../../../validators/auth-validator';
import { AbstractFormComponent } from 'src/app/abstract/abstract-form.component';

@Component({
  selector: 'app-request-password-reset',
  templateUrl: './request-password-reset.component.html',
  styleUrls: ['./request-password-reset.component.scss']
})
export class RequestPasswordResetComponent extends AbstractFormComponent implements OnInit {
  public validator: AuthValidator = new AuthValidator();

  constructor(
      private formBuilder: FormBuilder,
      private Auth: AuthService,
  ) {
    super();
  }

  ngOnInit() {
    this.form = this.formBuilder.group({
      email: this.validator.rules.email,
    });
  }

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
