import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { environment } from '../../../environments/environment';

@Injectable({
  providedIn: 'root'
})
export class SubcategoryService {

  constructor(
    private http: HttpClient,
  ) { }

  get(search: string) {
    return this.http.get(`${environment.backendUri}/subcategory/?search=${search}`);
  }

  store(data) {
    return this.http.post(`${environment.backendUri}/subcategory`, data);
  }
}
