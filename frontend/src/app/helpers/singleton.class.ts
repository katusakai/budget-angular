import { FormBuilder } from '@angular/forms';

export class SingletonClass {

  private static _formBuilder: FormBuilder ;

  public static getFormBuilder(): FormBuilder {
    if (this._formBuilder === undefined) {
      this._formBuilder = new FormBuilder();
    }
    return this._formBuilder;
  }
}
