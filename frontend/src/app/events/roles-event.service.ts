import { Injectable } from '@angular/core';
import { EventServiceInterface } from './event-service-interface';

@Injectable({
  providedIn: 'root'
})
export class RolesEventService implements EventServiceInterface {

  public event: Event;

  constructor() {
    this.event = new Event('role-update');
  }
}
