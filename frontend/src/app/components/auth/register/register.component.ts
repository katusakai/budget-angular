import { Component, OnInit } from '@angular/core';
import { AuthService } from '../../../services/auth/auth.service';
import { RegisterService } from '../../../services/auth/register.service';
import { AuthValidator } from '../../../validators/auth-validator';
import { AbstractFormComponent } from 'src/app/abstract/abstract-form.component';

@Component({
  selector: 'app-register',
  templateUrl: './register.component.html',
  styleUrls: ['./register.component.scss']
})
export class RegisterComponent extends AbstractFormComponent implements OnInit {

  public validator: AuthValidator = new AuthValidator();

  constructor(
      private Auth: AuthService,
      private Register: RegisterService,
  ) {
    super();
  }

  ngOnInit() {
    this.form = this._formBuilder.group({
      email: this.validator.rules.email,
      name: this.validator.rules.name,
      password: this.validator.rules.password,
      password_confirmation: this.validator.rules.passwordConfirmation,
    }, );
  }

  onRegister() {
    if (this.validator.handleFrontend(this.f)) {
      this.Auth.register({
        email: this.f.email.value,
        name: this.f.name.value,
        password: this.f.password.value,
        password_confirmation: this.f.password_confirmation.value,
      }).subscribe(
        data => {
          this.Register.handleResponse(data)
        },
        error => {
          this.validator.handleBackend(error.error.error);
        }
      );
    }
  }
}
