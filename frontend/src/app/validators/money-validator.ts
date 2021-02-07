import { Validators } from '@angular/forms';
import { AbstractValidator, errorPropertiesType } from './abstract-validator';

export class MoneyValidatedFields {
  public subCategoryId = errorPropertiesType;
  public amount = errorPropertiesType;
  public description = errorPropertiesType;
}

export class MoneyValidator extends AbstractValidator<MoneyValidatedFields> {

    protected _codes: MoneyValidatedFields = new MoneyValidatedFields();

    protected _messages: MoneyValidatedFields = {
      subCategoryId: {
        required: 'Subcategory is required',
      },
      amount: {
        required: 'Amount is required',
      },
      description: {
      },
    }

  protected setRules(): void {
    this._rules = {
      subCategoryId: ['', [Validators.required]],
      amount: ['', [Validators.required]],
      description: [''],
    }
  }
}



