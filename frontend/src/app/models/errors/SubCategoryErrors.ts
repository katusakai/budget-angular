export class SubCategoryErrors {
  public category_id;
  public name;

  public handleBackend(errors) {
    this.clearErrors();

    if (errors.category_id) {
      errors.category_id.forEach(error => {
        this.category_id.push(error)
      })
    }

    if (errors.name) {
      errors.name.forEach(error => {
        this.name.push(error)
      })
    }
  }

  public clearErrors() {
    this.category_id = [];
    this.name = [];
  }
}
