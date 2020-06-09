import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { environment } from '../../../environments/environment';
import { UserDataService } from '../auth/user-data.service';

@Injectable({
  providedIn: 'root'
})
export class MoneyService {

  constructor(
    private http: HttpClient,
    private UserData: UserDataService,
  ) {
  }

  getMonthly(date: string) {
    return this.http.get(`${environment.backendUri}/money/${this.UserData.userId}/${date}`);
  }
}
