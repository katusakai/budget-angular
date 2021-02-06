import { Inject, Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { QueryParams, queryString } from '../../helpers/query-params';
import { AbstractModelService } from '../abstract-model.service';

@Injectable({
  providedIn: 'root'
})
export class CategoryService extends AbstractModelService {

  constructor(
    @Inject('API_URL') private apiUrl: string,
    private _http: HttpClient,
  ) {
    super();
  }

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
