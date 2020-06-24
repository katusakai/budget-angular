import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import  {environment } from '../../../environments/environment';

@Injectable({
  providedIn: 'root'
})
export class CategoryService {

  constructor(
    private http: HttpClient,
  ) { }

  get(search: string) {
    return this.http.get(`${environment.backendUri}/category/?search=${search}`);
  }

  store(data) {
    return this.http.post(`${environment.backendUri}/category`, data);
  }
}
