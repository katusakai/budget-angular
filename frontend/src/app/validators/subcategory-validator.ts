import { Validators } from '@angular/forms';
import { AbstractValidator, errorPropertiesType } from './abstract-validator';

export class SubcategoryValidatedFields {
  public categoryId = errorPropertiesType;
  public name = errorPropertiesType;
}

export class SubcategoryValidator extends AbstractValidator<SubcategoryValidatedFields> {

    protected _codes: SubcategoryValidatedFields = new SubcategoryValidatedFields();

    protected _messages: SubcategoryValidatedFields = {
      categoryId: {
        required: 'Category is required'
      },
      name: {
        required: 'SubCategory name is required'
      },
    }

  protected setRules(): void {
    this._rules = {
      categoryId: ['', [Validators.required]],
      name: ['', [Validators.required]]
    }
  }
}



