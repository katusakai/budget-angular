import { Component, OnInit } from '@angular/core';
import { AuthService } from '../../../services/auth/auth.service';
import { RegisterService } from '../../../services/auth/register.service';
import { FormBuilder, FormGroup } from '@angular/forms';
import { AuthValidator } from '../../../validators/auth-validator';

@Component({
  selector: 'app-register',
  templateUrl: './register.component.html',
  styleUrls: ['./register.component.scss']
})
export class RegisterComponent implements OnInit {

  public form: FormGroup;
  public validator: AuthValidator = new AuthValidator();

  constructor(
      private formBuilder: FormBuilder,
      private Auth: AuthService,
      private Register: RegisterService,
  ) { }

  ngOnInit() {
    this.form = this.formBuilder.group({
      email: this.validator.rules.email,
      name: this.validator.rules.name,
      password: this.validator.rules.password,
      password_confirmation: this.validator.rules.passwordConfirmation,
    }, );
  }

  get f() { return this.form.controls; }

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
