import { Component, OnInit } from '@angular/core';
import { NgbModal } from '@ng-bootstrap/ng-bootstrap';
import { SubcategoryService } from '../../../../services/budget/subcategory.service';
import { Response } from '../../../../models/response';
import { Subcategory } from '../../../../models/subcategory';

@Component({
  selector: 'app-money-form',
  templateUrl: './money-form.component.html',
  styleUrls: ['./money-form.component.scss']
})
export class MoneyFormComponent implements OnInit {

  subCategories: [Subcategory];
  form: any;
  message: string;
  search: string;
  timeout: any;

  constructor(
    private _modalService: NgbModal,
    private subcategoryService: SubcategoryService
  ) {}

  ngOnInit(): void {
    this.search= '';
    this.getSubCategories();
    this.form = {
      id: null,
      sub_category_id: null,
      amount: null,
      description: null,
      visualData: {title: null, button: null},
      method: null,
    };
  }

  getSubCategories() {
    this.subcategoryService.get(this.search).subscribe((response: Response) => {
      console.log(response);
      this.subCategories = response.data;
    })
  }

  formSubmit(){

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
