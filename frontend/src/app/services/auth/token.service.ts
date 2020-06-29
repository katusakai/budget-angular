import { Injectable } from '@angular/core';
import { AbstractLocalStorageService } from './abstract-local-storage.service';

@Injectable({
  providedIn: 'root'
})
export class TokenService  extends AbstractLocalStorageService{

  constructor() {
    super();
    this.localStorageKey = 'access_token';
  }

  loggedIn() {
    return !!this.get();
  }

}



