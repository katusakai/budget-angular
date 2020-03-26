import { Injectable } from '@angular/core';
import { CanActivate, ActivatedRouteSnapshot, RouterStateSnapshot, UrlTree } from '@angular/router';
import { Observable } from 'rxjs';
import { ConfigurationService } from "../services/admin/configuration.service";
import { map,} from "rxjs/operators";

@Injectable({
  providedIn: 'root'
})
export class CanRegisterGuard implements CanActivate {

  constructor(
    private _Configuration: ConfigurationService
  ) {
  }

  canActivate(
    next: ActivatedRouteSnapshot,
    state: RouterStateSnapshot): Observable<boolean | UrlTree> | Promise<boolean | UrlTree> | boolean | UrlTree {
    return this._Configuration.show(1).pipe(
      map(data=> {
        let value = data['data']['value'];
        return value === 'true';
      })
    );
  }
  
}
