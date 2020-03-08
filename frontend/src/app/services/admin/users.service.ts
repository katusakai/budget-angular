import { Injectable } from '@angular/core';
import { HttpClient } from "@angular/common/http";
import { environment } from "../../../environments/environment";

@Injectable({
  providedIn: 'root'
})
export class UsersService {

  constructor(
      private http: HttpClient,
  ) { }

  index(page) {
    return this.http.get(`${environment.backendUri}/admin/user?page=${page}`);
  }
}
