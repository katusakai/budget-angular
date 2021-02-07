import { AbstractLocalStorageService } from './abstract-local-storage.service';
import { Injectable} from '@angular/core';

@Injectable({
  providedIn: 'root'
})
export class UserIdService extends AbstractLocalStorageService{

  constructor() {
    super();
    this.localStorageKey = 'user_id';
  }

}
