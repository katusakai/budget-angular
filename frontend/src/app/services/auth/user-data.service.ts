import { Injectable } from '@angular/core';
import { AuthService } from './auth.service';
import { IUser } from '../../models';
import {RolesService} from "./roles.service";

@Injectable({
  providedIn: 'root'
})
export class UserDataService {
  public loggedIn: boolean;
  public user: IUser;
  public roles: Array<string>;
  private roleSetter: number;

  constructor(
      private Auth: AuthService,
      private Roles: RolesService
  ) {
    this.Auth.status.subscribe(
        value => {
          this.loggedIn = value;
          if (this.loggedIn) {
            this.Auth.getCurrentUser().subscribe(data  => this.user  = data);
            if (!(this.roles = this.Roles.get())) {
               this.roleSetter = setInterval( () => this.roles = this.Roles.get(),500);
            }

          } else {
            delete this.user;
            delete this.roles;
            this.Roles.remove();
            clearInterval(this.roleSetter)
          }
        }
    );
  }
}
