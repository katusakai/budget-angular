import { Component, OnInit } from '@angular/core';
import { AuthService } from '../../../services/auth/auth.service';
import { LoginService } from "../../../services/auth/login.service";

@Component({
  selector: 'app-login',
  templateUrl: './login.component.html',
  styleUrls: ['./login.component.scss']
})
export class LoginComponent implements OnInit {

  public form = {
    email: null,
    password: null
  };

  public error = null;

  constructor(
      private Auth: AuthService,
      private Login: LoginService
  ) { }

  ngOnInit() {
  }

  onSubmit() {
    this.Auth.login(this.form).subscribe(
        data => {
          this.Login.handleResponse(data, '/');
        }
    );
  }

}
