import { Injectable } from '@angular/core';

@Injectable({
  providedIn: 'root'
})
export class TokenService {

  constructor() { }

  set(token) {
    localStorage.setItem('api_token', token);
  }

  get() {
    return localStorage.getItem(('api_token'));
  }

  remove() {
    localStorage.removeItem('api_token');
  }

  loggedIn() {
    return !!this.get();
  }

}



