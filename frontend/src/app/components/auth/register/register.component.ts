import { Component, OnInit } from '@angular/core';
import { AuthService } from '../../../services/auth/auth.service';
import { RegisterService } from '../../../services/auth/register.service';
import { FormBuilder, FormGroup } from '@angular/forms';
import { AuthErrors } from '../../../models/errors/AuthErrors';
import { ValidatorService } from '../../../services/auth/validator.service';

@Component({
  selector: 'app-register',
  templateUrl: './register.component.html',
  styleUrls: ['./register.component.scss']
})
export class RegisterComponent implements OnInit {

  public form: FormGroup;

  public errors: AuthErrors;

  constructor(
      private formBuilder: FormBuilder,
      private Auth: AuthService,
      private Register: RegisterService,
      private Validator: ValidatorService,
  ) { }

  ngOnInit() {
    this.form = this.formBuilder.group({
      email: this.Validator.email,
      name: this.Validator.name,
      password: this.Validator.password,
      password_confirmation: this.Validator.password,
    }, );
    this.errors = new AuthErrors();
  }

  get f() { return this.form.controls; }

  onRegister() {
    if (this.errors.handleFrontend(this.f)) {
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
          this.errors.handleBackend(error.error.error);
        }
      );
    }
  }
}
