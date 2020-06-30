export class MoneyErrors {
  public sub_category_id;
  public amount;
  public description;

  public handleBackend(errors) {
    this.clearErrors();

    if (errors.sub_category_id) {
      errors.sub_category_id.forEach(error => {
        this.sub_category_id.push(error)
      })
    }

    if (errors.amount) {
      errors.amount.forEach(error => {
        this.amount.push(error)
      })
    }

    if (errors.description) {
      errors.description.forEach(error => {
        this.description.push(error)
      })
    }
  }

  public clearErrors() {
    this.sub_category_id = [];
    this.amount = [];
    this.description = [];
  }
}
