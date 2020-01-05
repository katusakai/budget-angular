import { Component, OnInit } from '@angular/core';
import { AuthService } from '../../../services/auth.service';
import { TokenService } from '../../../services/token.service';
import { Router } from '@angular/router';

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
      private Token: TokenService,
      private router: Router
  ) { }

  ngOnInit() {
  }

  onSubmit() {
    this.Auth.login(this.form).subscribe(
        data => {
          this.handleResponse(data);
        }
    );
  }

  handleResponse(data) {
    this.Token.set(data.api_token);
    this.Auth.changeAuthStatus(true);
    this.router.navigateByUrl('/');
  }

}
