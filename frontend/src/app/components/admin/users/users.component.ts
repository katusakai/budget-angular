import { Component, OnInit } from '@angular/core';
import { UsersService } from "../../../services/admin/users.service";
import { IUser } from "../../../models";
import { ActivatedRoute, Router } from "@angular/router";
import { Debounce } from '../../../helpers/debounce.decorator'
import { RolesService } from "../../../services/admin/roles.service";
import { IRole } from "../../../models/role";
@Component({
  selector: 'app-users',
  templateUrl: './users.component.html',
  styleUrls: ['./users.component.scss']
})
export class UsersComponent implements OnInit {

  public users: IUser[];
  public roles: IRole[];
  page: number;
  limit: number;
  search: string;
  collectionSize: number;
  defaultLimit: number;

  constructor(
    private _User: UsersService,
    private _ActivatedRoute: ActivatedRoute,
    private _Router: Router,
    private _Role: RolesService,
  ) {
  }

  ngOnInit(): void {
    this.page = 0;
    this.collectionSize = 1000000;  //if initial value is too small, default page will always be 1
    this.defaultLimit = 15;
    this.limit = this.defaultLimit;
    this.search = '';
    this.getRouteParams();
    this.updateList();
    this.getRoles();
  }

  updateList() {
    this._User.index(this.page, this.limit, this.search).subscribe(data => {
      this.users = data['data']['data'];
      this.collectionSize = data['data']['total'];
    });
    this.syncQueryParams();
  }

  @Debounce(1000)
  searchData() {
    this.page = 1;
    this.updateList();
  }

  getRoles() {
    this._Role.index().subscribe(data => {
      this.roles = data['data'];
    })
  }

  private getRouteParams() {
    this._ActivatedRoute.queryParams.subscribe(params => {
      if (params['page']) {
        this.page = +params['page'];
      }
      if (params['limit']) {
        this.limit = +params['limit'];
      }
      if (params['search']) {
        this.search = params['search'];
      }
    });
  }

  private syncQueryParams() {
    this._Router.navigate(['.'], {
      relativeTo: this._ActivatedRoute,
      queryParams: {
        page: this.page === 0 || this.page === 1 ? null : this.page,
        limit: this.limit === this.defaultLimit ? null : this.limit,
        search: this.search === '' ? null : this.search,
      }
    });
  }

  ifHasRole(roleId, userRoles) {
    for (let role of userRoles) {
      if (roleId === role['id']) {
        return true;
      }
    }
    return false;
  }
}
