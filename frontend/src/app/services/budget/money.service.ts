import { Inject, Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { UserIdService } from '../auth/user-id.service';
import { AbstractModelService } from '../abstract-model.service';

@Injectable({
  providedIn: 'root'
})
export class MoneyService extends AbstractModelService {

  constructor(
    @Inject('API_URL') private apiUrl: string,
    private http: HttpClient,
    private _userId: UserIdService
  ) {
    super();
  }

  getMonthly(date: string) {
    return this.http.get(`${this.apiUrl}/money/${this._userId.get()}/${date}`);
  }

  store(data) {
    return this.http.post(`${this.apiUrl}/money`, data);
  }

  update(id, data) {
    return this.http.put(`${this.apiUrl}/money/${id}`, data);
  }

  destroy(id) {
    return this.http.delete(`${this.apiUrl}/money/${id}`);
  }
}
