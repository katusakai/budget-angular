import { Injectable } from '@angular/core';

@Injectable({
  providedIn: 'root'
})
export class RolesEventService {

  public event: Event;

  constructor() {
    this.event = new Event('role-update');
  }
}
