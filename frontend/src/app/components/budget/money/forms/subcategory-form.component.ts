import { Component, Input, OnInit } from '@angular/core';
import { Response } from '../../../../models/response';
import { CategoryService } from '../../../../services/budget/category.service';
import { Category } from '../../../../models/money/category';
import { Debounce } from '../../../../helpers/debounce.decorator';
import { SubcategoryService } from '../../../../services/budget/subcategory.service';
import { FormBuilder } from '@angular/forms';
import { SubCategoryErrors } from '../../../../models/errors/SubCategoryErrors';
import { AbstractFormComponent } from '../../../../abstract/abstract-form.component';

@Component({
  selector: 'app-subcategory-form',
  templateUrl: './subcategory-form.component.html',
  styleUrls: ['./subcategory-form.component.scss']
})
export class SubcategoryFormComponent extends AbstractFormComponent implements OnInit {

  @Input() subCategoryName: string;

  public categories: [Category];
  public search: string;
  public errors: SubCategoryErrors

  constructor(
    private _categoryService: CategoryService,
    private _subcategoryService: SubcategoryService,
    private _formBuilder: FormBuilder,
  ) {
    super();
  }

  ngOnInit(): void {
    this.search= '';
    this.getCategories();

    this.form = this._formBuilder.group({
      category_id: [''],
      name: ['']
    });
    this.form.setValue({
      category_id: null,
      name: this.subCategoryName
    });
    this.errors = new SubCategoryErrors();
  }

  get f() { return this.form.controls; }

  getCategories() {
    this._categoryService.get(this.search).subscribe((response: Response) => {
      this.categories = response.data;
    })
  }

  formSubmit() {
    this.create();
  }

  create() {
    this._subcategoryService.store({
      category_id: this.f.category_id.value,
      name: this.f.name.value
    }).subscribe(
      (response: Response) => {
        this.message = response.message;
        this.errors.clearErrors();
      },
      error => this.errors.handleBackend(error.error.error)
    );
  }

  @Debounce(1000)
  searchCategories() {
    this.getCategories();
  }

}
