import { Injectable } from '@angular/core';

@Injectable({
  providedIn: 'root'
})
export class TokenService {

  private readonly accessToken: string;

  constructor() {
    this.accessToken = 'access_token';
  }

  set(token) {
    localStorage.setItem(this.accessToken, token);
  }

  get() {
    return localStorage.getItem((this.accessToken));
  }

  remove() {
    localStorage.removeItem(this.accessToken);
  }

  loggedIn() {
    return !!this.get();
  }

}



