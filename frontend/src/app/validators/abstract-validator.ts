import { AbstractControl, FormControl } from '@angular/forms';
import { camelCase } from 'camel-case';

interface FormGroupControlInterface {
  [key: string]: AbstractControl
}
/**
 * Type and initial value for validation error properties
 */
export const errorPropertiesType: [] | object = [];

/**
 * Abstract class for errors
 */
export abstract class AbstractValidator<T> {

  /**
   * Validation rules are stored here
   * @protected
   */
  protected _rules: T;

  /**
   * Dirty form errors are stored here
   * @protected
   */
  protected abstract _codes: T;

  /**
   * All possible messages for frontend validation error codes
   * @protected
   */
  protected abstract _messages: T;

  get rules(): T {
    return this._rules;
  }

  get codes(): T {
    return this._codes;
  }

  /**
   * Abstract class constructor
   */
  constructor() {
    this.setRules();
  }

  /**
   * Initialize frontend validation rules
   * @protected
   */
  protected abstract setRules(): void;

  /**
   * Stores errors from frontend validator
   * @param formGroupControls
   */
  public handleFrontend(formGroupControls: FormGroupControlInterface): boolean {
    this.clearErrors();

    Object.entries(formGroupControls).forEach(
      ([name, value]) => {
        const validator = value as FormControl;
        if (validator.errors) {
          this.addMessages(validator,name);
        }
      }
    )

    let noErrors = true;
    if (Object.values(this.codes).find(value => value.length)) {
      noErrors = false;
    }
    return noErrors;
  }

  /**
   * Stores errors from backend validation call
   * @param errors
   */
  public handleBackend(errors): void {
    this.clearErrors();
    Object.entries(errors).forEach(
      ([key, value]) => {
        this.codes[key] = value;
      }
    );
  }

  /**
   * Updates codes with dirty validation messages
   * @param validator
   * @param name
   * @private
   */
  private addMessages(validator: FormControl, name:string): void {
    Object.entries(validator.errors).forEach(
      ([key, value]) => {
        if (value) {
          const camelCasedName = camelCase(name);
          this.codes[camelCasedName].push(this._messages[camelCasedName][key]);
        }
      }
    )
  }

  /**
   * Clears codes before filling it with new messages
   * @private
   */
  private clearErrors(): void {
    Object.keys(this.codes).forEach(key => {
        this.codes[key] = [];
      }
    )
  }
}
