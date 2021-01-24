import { Input } from '@angular/core';
import { FormBuilder, FormGroup } from '@angular/forms';
import { SingletonClass } from '../helpers/singleton.class';

export abstract class AbstractFormComponent<T = any> {

  @Input() callType: string | 'Create' | 'Update';

  public form: FormGroup;

  public message: string;

  public abstract validator: any;

  get f() { return this.form.controls; }

  protected _formBuilder: FormBuilder;

  constructor() {
    this._formBuilder = SingletonClass.getFormBuilder();
  }

}
