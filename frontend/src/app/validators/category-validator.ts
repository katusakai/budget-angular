import { Validators } from '@angular/forms';
import { AbstractValidator, errorPropertiesType } from './abstract-validator';

export class CategoryValidatedFields {
  public name = errorPropertiesType;
}

export class CategoryValidator extends AbstractValidator<CategoryValidatedFields> {

    protected _codes: CategoryValidatedFields = new CategoryValidatedFields();

    protected _messages: CategoryValidatedFields = {
      name: {
        required: 'Category name is required'
      },
    }

  protected setRules(): void {
    this._rules = {
      name: ['', [Validators.required]]
    }
  }
}



