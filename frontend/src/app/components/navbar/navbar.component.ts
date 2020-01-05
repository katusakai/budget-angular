import { Component, OnInit } from '@angular/core';
import { TokenService } from "../../services/auth/token.service";
import { AuthService } from "../../services/auth/auth.service";
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
    this.Auth.status.subscribe(value => this.loggedIn = value);
  }

  logout(event: MouseEvent) {
    event.preventDefault();
    this.Logout.handleResponse();
  }

}
