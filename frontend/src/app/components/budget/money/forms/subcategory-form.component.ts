import { Component, OnInit } from '@angular/core';
import { Response } from '../../../../models/response';
import { CategoryService } from '../../../../services/budget/category.service';
import { Category } from '../../../../models/money/category';

@Component({
  selector: 'app-subcategory-form',
  templateUrl: './subcategory-form.component.html',
  styleUrls: ['./subcategory-form.component.scss']
})
export class SubcategoryFormComponent implements OnInit {

  categories: [Category];
  search: string;
  form: any;
  timeout: any;
  message: string;

  constructor(
    private _categoryService: CategoryService
  ) { }

  ngOnInit(): void {
    this.search= '';
    this.getCategories();
    this.form = {
      id: null,
      category_id: null,
      name: null,
      visualData: {title: null, button: null},
      method: null,
    }
  }

  getCategories() {
    this._categoryService.get(this.search).subscribe((response: Response) => {
      this.categories = response.data;
    })
  }

  formSubmit() {

  }

  searchCategories() {
    clearTimeout(this.timeout);
    this.timeout = setTimeout(() => {
      this.getCategories();
    }, 1000)
  }

}
