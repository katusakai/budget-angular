import { Injectable } from '@angular/core';
import { Validators } from '@angular/forms';

@Injectable({
  providedIn: 'root'
})
export class ValidatorService {

  public email;
  public name;
  public password;
  public password_confirmation;

  constructor() {
    this.email = ['', [Validators.required, Validators.email, Validators.max(255)]];
    this.name = ['', [Validators.required, Validators.max(255)]];
    this.password = ['', [Validators.required, Validators.minLength(8)]]
    this.password_confirmation = ['', [Validators.required, Validators.minLength(8)]];
  }
}
