import { Injectable } from '@angular/core';
import { AuthService } from './auth.service';
import { IUser } from '../../models';
import { RolesService } from "./roles.service";

@Injectable({
  providedIn: 'root'
})
export class UserDataService {
  public loggedIn: boolean;
  public user: IUser;
  public roles: Array<string>;

  constructor(
      private Auth: AuthService,
      private Roles: RolesService,
  ) {
      addEventListener('role-update', () => {
          this.getRoles();
      });
    this.set();
  }

  private set() {
      this.Auth.status.subscribe(
          value => {
              this.loggedIn = value;
              if (this.loggedIn) {
                  this.Auth.getCurrentUser().subscribe(data  => this.user  = data);
                this.getRoles();
              } else {
                  delete this.user;
                  delete this.roles;
                  this.Roles.remove();
              }
          }
      );
  }

  private getRoles(){
      this.Roles.get().subscribe(data => {
          this.roles = data;
      });
  }
}
