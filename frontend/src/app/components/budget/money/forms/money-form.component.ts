import { Component, Input, OnInit } from '@angular/core';
import { NgbModal } from '@ng-bootstrap/ng-bootstrap';
import { SubcategoryService } from '../../../../services/budget/subcategory.service';
import { Response } from '../../../../models/response';
import { Subcategory } from '../../../../models/money/subcategory';
import { MoneyService } from '../../../../services/budget/money.service';
import { Debounce } from '../../../../helpers/debounce.decorator';
import { Money } from '../../../../models/money/money';
import { AbstractFormComponent } from '../../../../abstract/abstract-form.component';
import { MoneyValidator } from '../../../../validators/money-validator';


@Component({
  selector: 'app-money-form',
  templateUrl: './money-form.component.html',
  styleUrls: ['./money-form.component.scss']
})
export class MoneyFormComponent extends AbstractFormComponent implements OnInit {

  @Input() spending: Money;

  public subCategories: [Subcategory];
  public validator: MoneyValidator = new MoneyValidator();
  public search: string;
  public visualData: {title: string, button: string};

  constructor(
    private _modalService: NgbModal,
    private _subcategoryService: SubcategoryService,
    private _money: MoneyService,
  ) {
    super()
  }

  ngOnInit(): void {
    this.search= '';
    this.getSubCategories();
    this.initialize();
  }

  protected getSubCategories() {
    this._subcategoryService.get(this.search).subscribe((response: Response) => {
      this.subCategories = response.data;
      this.setSubCategoryOption();
    })
  }

  public formSubmit() {
    switch (this.callType.toLowerCase()) {
      case 'create':
        this.create();
        break;
      case 'update':
        this.update();
        break;
    }
  }

  protected create() {
    if(this.validator.handleFrontend(this.f)) {
      this._money.store({
        sub_category_id: this.f.sub_category_id.value,
        amount: this.f.amount.value,
        description: this.f.description.value
      }).subscribe(
        (response: Response) => {
          this.message = response.message;
          this.form.reset();
          this._money.$reload.next();
        },
        error => this.validator.handleBackend(error.error.error)
      );
    }
  }

  protected update() {
    if(this.validator.handleFrontend(this.f)) {
      this._money.update(this.spending.id, {
        sub_category_id: this.f.sub_category_id.value,
        amount: this.f.amount.value,
        description: this.f.description.value
      }).subscribe(
        (response: Response) => {
          this.message = response.message;
          this._money.$reload.next();
        },
      error => this.validator.handleBackend(error.error.error)
      );
    }
  }

  public delete() {
    if (confirm('Do you really want to delete this entry?')) {
      this._money.destroy(this.spending.id)
        .subscribe(
          (response: Response) => {
            this.message = response.message;
            this.form.reset();
            this.dismiss('Deleted entry');
            this._money.$reload.next();
          }
        )
    }
  }

  @Debounce(1000)
  searchSubCategories() {
    this.getSubCategories();
  }

  dismiss(reason?: string) {
    this._modalService.dismissAll(reason);
  }

  private initialize() {
    this.form = this._formBuilder.group({
      sub_category_id: [''],
      amount: [''],
      description: ['']
    });

    switch (this.callType.toLowerCase()) {

      case 'create':
        this.visualData = {button: 'Create', title: 'Create'};
        break;

      case 'update':
        this.visualData = {button: 'Update', title: 'Edit'}
        this.form.setValue({
          sub_category_id: this.spending.sub_category_id,
          amount: this.spending.amount,
          description: this.spending.description
        })
        break;
    }
  }

  setTwoNumberDecimal() {
    const value: number = this.f.amount.value;
    this.f.amount.patchValue(value.toFixed(2));
  }

  private setSubCategoryOption() {
    if (this.callType.toLowerCase() === 'create' && this.subCategories.length)
      this.form.patchValue({sub_category_id: this.subCategories[0].id});
  }
}
