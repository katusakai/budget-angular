import { Injectable } from '@angular/core';
import { HttpClient } from "@angular/common/http";
import { environment } from "../../../environments/environment";

@Injectable({
  providedIn: 'root'
})
export class ConfigurationService {

  constructor(
    private _http: HttpClient,
  ) { }

  index() {
    return this._http.get(`${environment.backendUri}/admin/configuration`);
  }

  show(id: number) {
    return this._http.get(`${environment.backendUri}/admin/configuration/${id}`);
  }

  update(id: number, data) {
    return this._http.put(`${environment.backendUri}/admin/configuration/${id}`, data);
  }
}
