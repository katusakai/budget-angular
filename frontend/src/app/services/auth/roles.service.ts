import { Injectable } from '@angular/core';
import { AuthService } from "./auth.service";

@Injectable({
  providedIn: 'root'
})
export class RolesService {

  private readonly userRoles: string;

  constructor(
      private Auth: AuthService
  ) {
    this.userRoles = 'user_roles';
  }

  private set() {
    this.Auth.getCurrentRoles().subscribe( data => {
      let roles = data;
      if (!roles[0]) {
        localStorage.setItem(this.userRoles, JSON.stringify(['no roles']));
        return;
      }
      localStorage.setItem(this.userRoles, JSON.stringify(roles));
    })
  }

  public get(): Array<string> {
    this.set();
    // @ts-ignore
    return localStorage.getItem(this.userRoles);
  }

  public remove() {
    localStorage.removeItem(this.userRoles);
  }


}
