import { Component, OnInit } from '@angular/core';
import { UsersService } from "../../../services/admin/users.service";
import { IUser } from "../../../models";

@Component({
  selector: 'app-users',
  templateUrl: './users.component.html',
  styleUrls: ['./users.component.scss']
})
export class UsersComponent implements OnInit {

  public users: IUser[];
  page: number;
  collectionSize: number;
  limit: number;
  constructor(
      private _User: UsersService,
  ) { }

  ngOnInit(): void {
    this.page = 0;
    this.limit = 15;
    this.updateList()
  }

  updateList() {
    this._User.index(this.page).subscribe(data => {
      this.users = data['data']['data'];
      this.collectionSize = data['data']['total'];
    })
  }
}
