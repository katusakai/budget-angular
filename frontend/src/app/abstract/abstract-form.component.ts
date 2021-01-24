import { Input } from '@angular/core';
import { FormGroup } from '@angular/forms';

export abstract class AbstractFormComponent<T = any> {

  @Input() callType: string | 'Create' | 'Update';

  public form: FormGroup;

  public message: string;

  public abstract validator: any;

  get f() { return this.form.controls; }
}
