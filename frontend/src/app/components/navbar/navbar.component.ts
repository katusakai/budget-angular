import { Component, OnInit } from '@angular/core';
import { TokenService } from "../../services/token.service";

@Component({
  selector: 'app-navbar',
  templateUrl: './navbar.component.html',
  styleUrls: ['./navbar.component.scss']
})
export class NavbarComponent implements OnInit {

  public loggedIn: boolean;
  constructor(
      private Token: TokenService
  ) { }

  ngOnInit() {

  }

  logout(event: MouseEvent) {
    event.preventDefault();
    this.Token.remove();
  }

}
