import { Component, OnInit } from '@angular/core';
import { UserDataService } from '../../services/auth/user-data.service';

@Component({
  selector: 'app-profile',
  templateUrl: './profile.component.html',
  styleUrls: ['./profile.component.scss']
})
export class ProfileComponent implements OnInit {

  constructor(
      public UserData: UserDataService,
  ) { }

  ngOnInit() {
    console.log(this.UserData.user)
  }

}
