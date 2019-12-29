import {Component, OnInit} from '@angular/core';
import { User } from './models';
import { AuthService } from './services/auth.service';

@Component({
  selector: 'app-root',
  templateUrl: './app.component.html',
  styleUrls: ['./app.component.scss']
})
export class AppComponent implements OnInit {
  title = 'frontend';

  constructor(private Auth: AuthService) {
  }

  ngOnInit() {
    this.Auth.getCurrentUser().subscribe(data => {
      console.log(data);
    });
  }
}
