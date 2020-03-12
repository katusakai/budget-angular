import { Injectable } from '@angular/core';
import { AuthService } from "./auth.service";
import { Observable } from "rxjs";
import { tap } from "rxjs/operators";
import { RolesEventService } from "../../events/roles-event.service";

@Injectable({
  providedIn: 'root'
})
export class RolesService {

  private readonly userRoles: string;
  private oldRoles;

  constructor(
      private Auth: AuthService,
      private RoleEvent: RolesEventService,
  ) {
    this.userRoles = 'user_roles';
  }

  public get(): Observable<any> {
    return new Observable(observer => {
      observer.next(localStorage.getItem(this.userRoles));
    }).pipe(
        tap(() => {
          this.set();
        }),
    );
  }

  private set() {
    this.Auth.getCurrentRoles().subscribe( data => {

      if (JSON.stringify(data) !== JSON.stringify(this.oldRoles)) {
        this.oldRoles = data;
        localStorage.setItem(this.userRoles, JSON.stringify(data));
        dispatchEvent(this.RoleEvent.event);
      }
    })
  }

  public remove() {
    localStorage.removeItem(this.userRoles);
  }
}
