export class AuthErrors {

    public email;
    public password;
    public name;
    public password_confirmation;

    public handleBackend(errors) {

        this.clearErrors();

        if (errors.email) {
            errors.email.forEach(email => {
                this.email.push(email);
                }
            );
        }

        if (errors.password) {
            errors.password.forEach(password => {
                    this.password.push(password);
                }
            );
        }

        if (errors.name) {
            errors.name.forEach(name => {
                    this.name.push(name);
                }
            );
        }

      if (errors.password_confirmation) {
          errors.password_confirmation.forEach(password_confirmation => {
              this.password_confirmation.push(password_confirmation);
          }
        );
      }
    }

    public handleFrontend(validator) {

        this.clearErrors();

        if (validator.email) {
            this.handleEmail(validator.email);
        }

        if (validator.password) {
            this.handlePassword(validator.password);
        }

        if (validator.name) {
            this.handleName(validator.name);
        }

        if (validator.password_confirmation) {
          this.handlePasswordConfirmation(validator.password_confirmation)
        }

        return !(this.email.length || this.password.length || this.name.length);
    }

    private handleEmail(validator) {
        if (validator.errors) {
            if (validator.errors.required) {
                this.email.push('Email is required');
            }
            if (validator.errors.email) {
                this.email.push('Not an email');
            }
            if (validator.errors.max) {
                this.email.push('Email is too long');
            }
        }
    }

    private handlePassword(validator) {
        if (validator.errors) {
            if (validator.errors.required) {
                this.password.push('Password is required');
            }
            if (validator.errors.minlength) {
                this.password.push('Password is too short');
            }
        }
    }

    private handleName(validator) {
        if (validator.errors) {
            if (validator.errors.required) {
                this.name.push('Name is required');
            }
            if (validator.errors.max) {
                this.name.push('Name is too long');
            }
        }
    }

    private handlePasswordConfirmation(validator) {
      if (validator.errors) {
        if (validator.errors.required) {
          this.password_confirmation.push('Password confirmation is required');
        }
        if (validator.errors.minlength) {
          this.password_confirmation.push('Password confirmation is too short');
        }
      }
    }

  private clearErrors() {
        this.email = [];
        this.password = [];
        this.name = [];
        this.password_confirmation = [];
    }
}
