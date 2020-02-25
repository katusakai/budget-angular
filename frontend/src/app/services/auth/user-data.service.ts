import { Injectable } from '@angular/core';
import { AuthService } from './auth.service';
import { IUser } from '../../models';

@Injectable({
  providedIn: 'root'
})
export class UserDataService {
  public loggedIn: boolean;
  public user: IUser;
  public roles;

  constructor(
      private Auth: AuthService
  ) {
    this.Auth.status.subscribe(
        value => {
          this.loggedIn = value;
          if (this.loggedIn) {
            this.Auth.getCurrentUser().subscribe(data  => this.user  = data);
            this.Auth.getCurrentRoles().subscribe(data => this.roles = data);
          } else {
            delete this.user;
            delete this.roles;
          }
        }
    );
  }
}
