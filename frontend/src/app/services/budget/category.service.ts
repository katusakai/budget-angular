import { Inject, Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { environment } from '../../../environments/environment';
import { QueryParams, queryString } from '../../helpers/query-params';

@Injectable({
  providedIn: 'root'
})
export class CategoryService {

  constructor(
    @Inject('API_URL') private apiUrl: string,
    private _http: HttpClient,
  ) { }

  public index(queryParams: QueryParams) {
    return this._http.get(`${this.apiUrl}/admin/category${queryString(queryParams)}`);
  }

  public get(search: string) {
    return this._http.get(`${this.apiUrl}/category?search=${search}`);
  }

  public store(data) {
    return this._http.post(`${this.apiUrl}/category`, data);
  }

  public update(id, data) {
    return this._http.put(`${this.apiUrl}/admin/category/${id}`, data);
  }
}
