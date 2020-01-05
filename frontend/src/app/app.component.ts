import { Component, OnInit } from '@angular/core';
import { environment } from "../environments/environment";
import { AuthService } from './services/auth/auth.service';
import { Title } from "@angular/platform-browser";

@Component({
  selector: 'app-root',
  templateUrl: './app.component.html',
  styleUrls: ['./app.component.scss']
})
export class AppComponent implements OnInit {
  public loggedIn: boolean;

  constructor(
      private Auth: AuthService,
      private TitleService: Title
  ) {
  }

  ngOnInit() {
    this.Auth.status.subscribe(value => this.loggedIn = value);
    if (this.loggedIn) {
      this.Auth.getCurrentUser().subscribe(data => {
      });
    }
    this.TitleService.setTitle(environment.appName);
  }
}
