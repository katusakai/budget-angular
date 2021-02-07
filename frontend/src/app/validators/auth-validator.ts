import { Validators } from '@angular/forms';
import { AbstractValidator, errorPropertiesType } from './abstract-validator';

export class AuthValidatedFields {
  public email = errorPropertiesType;
  public password = errorPropertiesType;
  public name = errorPropertiesType;
  public passwordConfirmation = errorPropertiesType;
}

export class AuthValidator extends AbstractValidator<AuthValidatedFields> {

    protected _codes: AuthValidatedFields = new AuthValidatedFields();

    protected _messages: AuthValidatedFields = {
      email: {
        required: 'Email is required',
        email: 'Not an email',
        max: 'Email is too long'
      },
      password: {
        required: 'Password is required',
        minlength: 'Password is too short'
      },
      name: {
        required: 'Name is required',
        max: 'Name is too long'
      },
      passwordConfirmation: {
        required: 'Password confirmation is required',
        minlength: 'Password confirmation is too short'
      }
    }

  protected setRules(): void {
    this._rules = {
      email: ['', [Validators.required, Validators.email, Validators.max(255)]],
      name: ['', [Validators.required, Validators.max(255)]],
      password: ['', [Validators.required, Validators.minLength(8)]],
      passwordConfirmation: ['', [Validators.required, Validators.minLength(8)]],
    }
  }
}



