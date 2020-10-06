import { Component, ElementRef, Input, OnInit, ViewChild } from '@angular/core';
import { FormBuilder } from '@angular/forms';
import { CategoryService } from '../../../../services/budget/category.service';
import { Response } from '../../../../models/response';
import { CategoryErrors } from '../../../../models/errors/CategoryErrors';
import { AbstractFormComponent } from '../../../../abstract/abstract-form.component';

@Component({
  selector: 'app-category-form',
  templateUrl: './category-form.component.html',
  styleUrls: ['./category-form.component.scss']
})
export class CategoryFormComponent extends AbstractFormComponent implements OnInit {

  @Input() initialCategoryName: string;

  @ViewChild('name') name: ElementRef;

  public errors: CategoryErrors

  constructor(
    private _categoryService: CategoryService,
    private _formBuilder: FormBuilder,
  ) {
    super();
  }

  ngOnInit(): void {
    this.initialize()
  }

  get f() { return this.form.controls; }

  protected initialize() {
    this.form = this._formBuilder.group({
      name: ['']
    });

    this.errors = new CategoryErrors();
  }

  formSubmit() {
    this.create();
  }

  create() {
    this._categoryService.store({
      name: this.initialCategoryName ? this.initialCategoryName : this.name.nativeElement.value
    }).subscribe(
      (response: Response) => {
        this.message = response.message;
        this.errors.clearErrors();
      },
      error => this.errors.handleBackend(error.error.error)
    )
  }
}
