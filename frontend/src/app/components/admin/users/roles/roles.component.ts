import { Component, Input, OnInit } from '@angular/core';
import { UserDataService } from "../../../../services/auth/user-data.service";
import { IRole } from "../../../../models/role";
import { RolesService } from "../../../../services/admin/roles.service";

@Component({
  selector: 'app-roles',
  templateUrl: './roles.component.html',
  styleUrls: ['./roles.component.scss']
})
export class RolesComponent implements OnInit {

  @Input() role: IRole;
  @Input() userId: number;
  @Input() userRoles: IRole[];

  hasRole: boolean;

  constructor(
    private _UserData: UserDataService,
    private _Roles: RolesService
  ) { }

  ngOnInit(): void {
    this.ifHasRole(this.role.id, this.userRoles)
  }

  ifHasRole(roleId, userRoles): boolean {
    for (let role of userRoles) {
      if (roleId === role['id']) {
        this.hasRole = true;
        return;
      }
    }
    this.hasRole = false;
  }

  update() {
    this._Roles.update(this.role.id, this.userId).subscribe(data => {
      console.log(data);
    })
  }
}
