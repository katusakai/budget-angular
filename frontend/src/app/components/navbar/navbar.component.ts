import { Component, OnInit } from '@angular/core';
import { TokenService } from "../../services/token.service";
import { AuthService } from "../../services/auth.service";
import { LogoutService } from "../../services/auth/logout.service";

@Component({
  selector: 'app-navbar',
  templateUrl: './navbar.component.html',
  styleUrls: ['./navbar.component.scss']
})
export class NavbarComponent implements OnInit {

  public loggedIn: boolean;
  constructor(
      private Token: TokenService,
      private Auth: AuthService,
      private Logout: LogoutService
  ) { }

  ngOnInit() {
    this.Auth.authStatus.subscribe(value => this.loggedIn = value);
  }

  logout() {
    this.Logout.handleResponse();
  }

}
