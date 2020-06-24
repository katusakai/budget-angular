export class CategoryErrors {
  public name;

  public handleBackend(errors) {
    this.clearErrors();

    if (errors.name) {
      errors.name.forEach(error => {
        this.name.push(error)
      })
    }
  }

  public clearErrors() {
    this.name = [];
  }
}
