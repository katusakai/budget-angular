import { Component, OnInit } from '@angular/core';
import { AuthService } from '../../../services/auth.service';

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
  ) { }

  ngOnInit() {
  }

  onSubmit() {
    this.Auth.login(this.form).subscribe(
        data => {
          console.log(data);
        }
    );
  }

}
