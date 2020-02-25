import { Component, OnInit } from '@angular/core';
import { LogoutService } from '../../services/auth/logout.service';
import { UserDataService } from "../../services/auth/user-data.service";

@Component({
  selector: 'app-navbar',
  templateUrl: './navbar.component.html',
  styleUrls: ['./navbar.component.scss']
})
export class NavbarComponent implements OnInit {

  constructor(
      private UserData: UserDataService,
      private Logout: LogoutService
  ) { }

  ngOnInit() {
  }

  logout(event: MouseEvent) {
    event.preventDefault();
    this.Logout.handleResponse();
  }

}
