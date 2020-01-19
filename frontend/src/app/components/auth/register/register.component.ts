import { Component, OnInit } from '@angular/core';
import { AuthService } from "../../../services/auth/auth.service";
import {RegisterService} from "../../../services/auth/register.service";

@Component({
  selector: 'app-register',
  templateUrl: './register.component.html',
  styleUrls: ['./register.component.scss']
})
export class RegisterComponent implements OnInit {

  public form = {
    email: null,
    name: null,
    password: null,
    password_confirmation: null
  };

  public error = {
    email: null,
    password: null,
    name: null,
  };

  constructor(
      private Auth: AuthService,
      private Register: RegisterService
  ) { }

  ngOnInit() {
  }

  onSubmit() {
    this.Auth.register(this.form).subscribe(
        data => this.Register.handleResponse(data),
        error => this.handleError(error),
    );
  }

  handleError(error) {
    this.error = error.error.errors;
    console.log(error);
  }

}
