import { Injectable } from '@angular/core';
import { Validators } from "@angular/forms";

@Injectable({
  providedIn: 'root'
})
export class ValidatorService {

  public email;
  public name;
  public password;

  constructor() {
    this.email = ['', [Validators.required, Validators.email, Validators.max(255)]];
    this.name = ['', [Validators.required, Validators.max(255)]];
    this.password = ['', [Validators.required, Validators.minLength(8)]];
  }
}
