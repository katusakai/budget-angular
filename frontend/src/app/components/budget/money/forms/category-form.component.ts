import { Component, ElementRef, Input, OnInit, ViewChild } from '@angular/core';
import { CategoryService } from '../../../../services/budget/category.service';
import { Response } from '../../../../models/response';
import { AbstractFormComponent } from '../../../../abstract/abstract-form.component';
import { CategoryValidator } from '../../../../validators/category-validator';
import { Category } from 'src/app/models/money/category';
@Component({
  selector: 'app-category-form',
  templateUrl: './category-form.component.html',
  styleUrls: ['./category-form.component.scss']
})
export class CategoryFormComponent extends AbstractFormComponent implements OnInit {

  @Input() category: Category;
  @Input() initialCategoryName: string;

  @ViewChild('name') name: ElementRef;

  public validator: CategoryValidator = new CategoryValidator;

  public visualData: {title: string, button: string};

  constructor(
    private _categoryService: CategoryService,
  ) {
    super();
  }

  ngOnInit(): void {
    this.initialize();
  }

  protected initialize() {
    this.form = this._formBuilder.group({
      name: this.validator.rules.name
    });

    switch (this.callType.toLowerCase()) {

      case 'create':
        this.visualData = {button: 'Create', title: 'Create'};
        break;

      case 'update':
        this.visualData = {button: 'Update', title: 'Edit'}
        this.form.setValue({
          name: this.category.name
        });
        break;
    }
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

  protected update() {
    if(this.validator.handleFrontend(this.f)) {
      this._categoryService.update(this.category.id, {
        name: this.initialCategoryName ? this.initialCategoryName : this.name.nativeElement.value
      }).subscribe(
        (response: Response) => {
          this.message = response.message;
        },
        error => {
          this.validator.handleBackend(error.error.error)
        }
      )
    }
  }
}
