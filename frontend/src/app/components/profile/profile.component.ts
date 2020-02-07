import { Component, OnInit } from '@angular/core';
import {AuthService} from '../../services/auth/auth.service';

@Component({
  selector: 'app-profile',
  templateUrl: './profile.component.html',
  styleUrls: ['./profile.component.scss']
})
export class ProfileComponent implements OnInit {

  constructor(
      private Auth: AuthService,
  ) { }

  ngOnInit() {
    this.Auth.getCurrentUser().subscribe(data => console.log(data))
  }

}
