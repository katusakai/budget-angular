import { Component, ElementRef, Input, OnInit, ViewChild } from '@angular/core';
import { FormBuilder } from '@angular/forms';
import { CategoryService } from '../../../../services/budget/category.service';
import { Response } from '../../../../models/response';
import { AbstractFormComponent } from '../../../../abstract/abstract-form.component';
import { CategoryValidator } from '../../../../validators/category-validator';
@Component({
  selector: 'app-category-form',
  templateUrl: './category-form.component.html',
  styleUrls: ['./category-form.component.scss']
})
export class CategoryFormComponent extends AbstractFormComponent implements OnInit {

  @Input() initialCategoryName: string;

  @ViewChild('name') name: ElementRef;

  public validator: CategoryValidator = new CategoryValidator;

  constructor(
    private _categoryService: CategoryService,
    private _formBuilder: FormBuilder,
  ) {
    super();
  }

  ngOnInit(): void {
    this.initialize()
  }

  protected initialize() {
    this.form = this._formBuilder.group({
      name: this.validator.rules.name
    });
  }

  formSubmit() {
    this.create();
  }

  create() {
    if(this.validator.handleFrontend(this.f)) {
      this._categoryService.store({
        name: this.initialCategoryName ? this.initialCategoryName : this.name.nativeElement.value
      }).subscribe(
        (response: Response) => {
          this.message = response.message;
        },
        error => this.validator.handleBackend(error.error.error)
      )
    }
  }
}
