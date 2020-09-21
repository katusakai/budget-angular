import { Component, Inject, OnInit } from '@angular/core';
import { Category } from '../../../../../models/money/category';
import { Debounce } from '../../../../../helpers/debounce.decorator';
import { Response } from '../../../../../models/response';
import { ActivatedRoute, Router } from '@angular/router';
import { CategoryService } from '../../../../../services/budget/category.service';
import { AbstractQueryComponent, IQueryParams } from '../../../../../helpers/query-params';

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
    private _Categories: CategoryService,
    @Inject(ActivatedRoute) _ActivatedRoute,
    @Inject(Router) _Router,
  ) {
    super(_ActivatedRoute,_Router);
  }

  ngOnInit(): void {
    this.updateList();
  }

  updateList() {
    this._Categories.index(this.queryParams).subscribe((response: Response) => {
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

}
