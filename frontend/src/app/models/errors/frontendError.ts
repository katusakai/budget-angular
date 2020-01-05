export class FrontendError {
    public email;
    public password;
    public name;

    public handle(validator) {
        this.email = [];
        this.password = [];
        this.name = [];

        if (validator.email) {
            this.handleEmail(validator.email);
        }

        if (validator.password) {
            this.handlePassword(validator.password);
        }

        if (validator.name) {
            this.handleName(validator.name);
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
                this.password.push('Name is required is required');
            }
            if (validator.errors.max) {
                this.email.push('Name is too long');
            }
        }

    }
}
