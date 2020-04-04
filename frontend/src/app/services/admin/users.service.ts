import { Injectable } from '@angular/core';
import { HttpClient } from "@angular/common/http";
import { environment } from "../../../environments/environment";

@Injectable({
  providedIn: 'root'
})
export class UsersService {

  constructor(
      private _http: HttpClient,
  ) { }

  index(page, limit, search) {
    return this._http.get(`${environment.backendUri}/admin/user?page=${page}&limit=${limit}&search=${search}`);
  }
}
