import { Component, OnInit } from '@angular/core';
import { NgbModal } from '@ng-bootstrap/ng-bootstrap';
import { SubcategoryService } from '../../../../services/budget/subcategory.service';
import { Response } from '../../../../models/response';
import { Subcategory } from '../../../../models/money/subcategory';
import { MoneyService } from '../../../../services/budget/money.service';
import { FormBuilder, FormGroup } from '@angular/forms';
import { MoneyErrors } from '../../../../models/errors/MoneyErrors';

@Component({
  selector: 'app-money-form',
  templateUrl: './money-form.component.html',
  styleUrls: ['./money-form.component.scss']
})
export class MoneyFormComponent implements OnInit {

  public subCategories: [Subcategory];
  public form: FormGroup;
  public errors: MoneyErrors;
  public message: string;
  public search: string;
  private timeout: any;

  constructor(
    private _modalService: NgbModal,
    private _subcategoryService: SubcategoryService,
    private _money: MoneyService,
    private _formBuilder: FormBuilder,
  ) {}

  ngOnInit(): void {
    this.search= '';
    this.getSubCategories();
    // this.form = {
    //   id: null,
    //   sub_category_id: null,
    //   amount: null,
    //   description: null,
    //   visualData: {title: null, button: null},
    //   method: null,
    // };
    // this.form.visualData.button = 'Create';
    // this.form.method = 'Create';
    this.form = this._formBuilder.group({
      sub_category_id: [''],
      amount: [''],
      description: ['']
    });
    this.errors = new MoneyErrors();

  }

  get f() { return this.form.controls; }

  getSubCategories() {
    this._subcategoryService.get(this.search).subscribe((response: Response) => {
      this.subCategories = response.data;
    })
  }

  formSubmit() {
    // switch (this.form.method) {
    //   case 'Create':
        this.create();
        // break;
      // case 'Update':
      //   this.update();
      //   break;
    // }
    // this.$root.$emit('getMonthStatistics')
  }

  create() {
    this._money.store({
      sub_category_id: this.f.sub_category_id.value,
      amount: this.f.amount.value,
      description: this.f.description.value
    }).subscribe((response: Response) => {
      console.log(response);
      this.message = response.message;
      this.errors.clearErrors();
    },
      error => this.errors.handleBackend(error.error.error)
    );
  }

  update() {

  }

  deleteMoney() {

  }

  searchSubCategories() {
    clearTimeout(this.timeout);
    this.timeout = setTimeout(() => {
      this.getSubCategories();
    }, 1000)
  }

  dismiss(reason: string) {
    this._modalService.dismissAll(reason);
  }

}
