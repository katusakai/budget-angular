import { Component, Input, OnInit } from '@angular/core';
import { NgbModal } from '@ng-bootstrap/ng-bootstrap';
import { SubcategoryService } from '../../../../services/budget/subcategory.service';
import { Response } from '../../../../models/response';
import { Subcategory } from '../../../../models/money/subcategory';
import { MoneyService } from '../../../../services/budget/money.service';
import { FormBuilder, FormGroup } from '@angular/forms';
import { MoneyErrors } from '../../../../models/errors/MoneyErrors';
import { Debounce } from '../../../../helpers/debounce.decorator';
import { Money } from '../../../../models/money/money';
import { MoneyEventService } from '../../../../events/money-event.service';


@Component({
  selector: 'app-money-form',
  templateUrl: './money-form.component.html',
  styleUrls: ['./money-form.component.scss']
})
export class MoneyFormComponent implements OnInit {

  @Input() callType: string;
  @Input() spending: Money;

  public subCategories: [Subcategory];
  public form: FormGroup;
  public errors: MoneyErrors;
  public message: string;
  public search: string;
  public visualData: {title: string, button: string};

  constructor(
    private _modalService: NgbModal,
    private _subcategoryService: SubcategoryService,
    private _money: MoneyService,
    private _formBuilder: FormBuilder,
    private _moneyEvent: MoneyEventService
  ) {}

  ngOnInit(): void {
    this.search= '';
    this.getSubCategories();
    this.form = this._formBuilder.group({
      sub_category_id: [''],
      amount: [''],
      description: ['']
    });
    this.loadForm();
    this.errors = new MoneyErrors();
  }

  get f() { return this.form.controls; }

  getSubCategories() {
    this._subcategoryService.get(this.search).subscribe((response: Response) => {
      this.subCategories = response.data;
    })
  }

  formSubmit() {
    switch (this.callType.toLowerCase()) {
      case 'create':
        this.create();
        break;
      case 'update':
        this.update();
        break;
    }
  }

  create() {
    this._money.store({
      sub_category_id: this.f.sub_category_id.value,
      amount: this.f.amount.value,
      description: this.f.description.value
    }).subscribe(
      (response: Response) => {
        this.message = response.message;
        this.errors.clearErrors();
        dispatchEvent(this._moneyEvent.moneyUpdater);
      },
      error => this.errors.handleBackend(error.error.error)
    );
  }

  update() {
      this._money.update(this.spending.id, {
        sub_category_id: this.f.sub_category_id.value,
        amount: this.f.amount.value,
        description: this.f.description.value
      }).subscribe(
        (response: Response) => {
          this.message = response.message;
          this.errors.clearErrors();
          dispatchEvent(this._moneyEvent.moneyUpdater);
        },
      error => this.errors.handleBackend(error.error.error)
      );
  }

  deleteMoney() {
    if (confirm('Do you really want to delete this entry?')) {
      this._money.destroy(this.spending.id)
        .subscribe(
          (response: Response) => {
            this.message = response.message;
            this.form.reset();
            this.dismiss('Deleted entry');
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

  loadForm() {
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

}
