import { Injectable } from '@angular/core';

@Injectable({
  providedIn: 'root'
})
export class MoneyEventService {

  public moneyUpdater: Event;

  constructor() {
    this.moneyUpdater = new Event('money-update');
  }

}
