import { Injectable } from '@angular/core';
import { AuthService } from './auth.service';
import { IUser } from '../../models';
import { RolesService } from './roles.service';

@Injectable({
  providedIn: 'root'
})
export class UserDataService {
  public loggedIn: boolean;
  public user: IUser;
  public roles: Array<string>;
  public userId: number;
  private oldUserId: number;

  constructor(
      private Auth: AuthService,
      private Roles: RolesService,
  ) {
      addEventListener('role-update', () => {
          this.getRoles();
      });
    this.setUserId();
    this.set();
  }

  private set() {
      this.Auth.status.subscribe(
          value => {
              this.loggedIn = value;
              if (this.loggedIn) {

                  this.Auth.getCurrentUser().subscribe((data: IUser)  => {
                    if(JSON.stringify(data.id) !== JSON.stringify(this.oldUserId)) {
                      this.oldUserId = data.id;
                      localStorage.setItem('user_id', JSON.stringify(data.id));
                    }
                    this.user  = data
                  });

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

  private setUserId() {
    this.userId =  +localStorage.getItem('user_id');
  }
}
