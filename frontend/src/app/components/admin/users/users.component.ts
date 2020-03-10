import { Component, OnInit } from '@angular/core';
import { UsersService } from "../../../services/admin/users.service";
import { IUser } from "../../../models";
import { ActivatedRoute, Router } from "@angular/router";

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
  defaultLimit: number;

  constructor(
      private _User: UsersService,
      private _ActivatedRoute: ActivatedRoute,
      private _Router: Router
  ) { }

  ngOnInit(): void {
    this.page = 0;
    this.collectionSize = 1000000;  //if initial value is too small, default page will always be 1
    this.defaultLimit = 15;
    this.limit = this.defaultLimit;
    this.getRouteParams();
    this.updateList();
  }

  updateList() {
    this._User.index(this.page, this.limit).subscribe(data => {
      this.users = data['data']['data'];
      this.collectionSize = data['data']['total'];
    });
    this.syncQueryParams();
  }

  private getRouteParams() {
    this._ActivatedRoute.queryParams.subscribe(params => {
      if (params['page']) {
        this.page = +params['page'];
      }
      if (params['limit']) {
        this.limit = +params['limit'];
      }
    });
  }

  private syncQueryParams() {
    this._Router.navigate(['.'], {
      relativeTo: this._ActivatedRoute,
      queryParams: {
        page: this.page === 0 || this.page === 1 ? null : this.page,
        limit: this.limit === this.defaultLimit ? null : this.limit,
      }
    });
  }
}
