import {Component, Input, OnInit} from '@angular/core';
import {UserDataService} from "../../../../services/auth/user-data.service";
import {IRole} from "../../../../models/role";

@Component({
  selector: 'app-roles',
  templateUrl: './roles.component.html',
  styleUrls: ['./roles.component.scss']
})
export class RolesComponent implements OnInit {

  @Input() role: IRole;
  @Input() userId: number;
  @Input() userRoles: IRole[];

  constructor(
    private _UserData: UserDataService,
  ) { }

  ngOnInit(): void {
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
