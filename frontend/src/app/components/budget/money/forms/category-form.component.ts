import { Component, Input, OnInit } from '@angular/core';
import { FormBuilder } from '@angular/forms';
import { CategoryService } from '../../../../services/budget/category.service';
import { Response } from '../../../../models/response';
import { CategoryErrors } from '../../../../models/errors/CategoryErrors';

@Component({
  selector: 'app-category-form',
  templateUrl: './category-form.component.html',
  styleUrls: ['./category-form.component.scss']
})
export class CategoryFormComponent implements OnInit {

  @Input() category_name: string;

  public form: any;
  public errors: CategoryErrors
  public message: string;

  constructor(
    private _categoryService: CategoryService,
    private _formBuilder: FormBuilder,
  ) { }

  ngOnInit(): void {
    this.form = this._formBuilder.group({
      name: ['']
    });

    this.form.setValue({
      name: this.category_name
    });

    this.errors = new CategoryErrors();

  }

  get f() { return this.form.controls; }

  formSubmit() {
    this.create();
  }

  create() {
    this._categoryService.store({
      name: this.f.name.value
    }).subscribe(
      (response: Response) => {
        this.message = response.message;
        this.errors.clearErrors();
      },
      error => this.errors.handleBackend(error.error.error)
    )
  }

}
