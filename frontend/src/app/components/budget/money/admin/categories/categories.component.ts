import { Component, Inject, OnInit } from '@angular/core';
import { Category } from '../../../../../models/money/category';
import { Debounce } from '../../../../../helpers/debounce.decorator';
import { Response } from '../../../../../models/response';
import { ActivatedRoute, Router } from '@angular/router';
import { CategoryService } from '../../../../../services/budget/category.service';
import { AbstractQueryComponent, IQueryParams } from '../../../../../helpers/query-params';
import { NgbModal } from '@ng-bootstrap/ng-bootstrap';
import { ModalComponent } from '../../../../generic/modal/modal.component';

@Component({
  selector: 'app-categories',
  templateUrl: './categories.component.html',
  styleUrls: ['./categories.component.scss']
})
export class CategoriesComponent extends AbstractQueryComponent implements OnInit {

  public categories: Category[];

  protected getDefaultQueryParams(): IQueryParams {
    return {
      page: 0,
      limit: 15,
      search: '',
      order: 'name',
      orderDirection: 'asc',
      deleted: '0',
    };
  }

  constructor(
    private _categoryService: CategoryService,
    @Inject(ActivatedRoute) _ActivatedRoute,
    @Inject(Router) _Router,
    private _modalService: NgbModal,
  ) {
    super(_ActivatedRoute,_Router);
  }

  ngOnInit(): void {
    this._categoryService.$reload.subscribe(() => {
      this.updateList();
    });
    this._categoryService.$reload.next();
  }

  updateList() {
    this._categoryService.index(this.queryParams).subscribe((response: Response) => {
      this.categories = response.data.data;
      this.collectionSize = response.data.total;
    });
    this.syncQueryParams();
  }

  @Debounce(1000)
  searchData() {
    this.queryParams.page = 1;
    this.updateList();
  }

  public categoryCreateForm(): void {
    if(this._modalService.hasOpenModals())
      this._modalService.dismissAll();

    const modalRef = this._modalService.open(ModalComponent);
    modalRef.componentInstance.properties = {
      title: 'Create category',
      form: {
        name: 'category',
        callType: 'create'
      }
    };
  }

  public categoryEditForm(category: Category): void {
    if(this._modalService.hasOpenModals())
      this._modalService.dismissAll();

      const modalRef = this._modalService.open(ModalComponent);
      modalRef.componentInstance.properties = {
        title: 'Update category',
        form: {
          name: 'category',
          callType: 'update'
        }
      };
      modalRef.componentInstance.model = category;
  }

}
