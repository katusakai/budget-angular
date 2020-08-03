import { ActivatedRoute, Router } from '@angular/router';

export interface IQueryParams {
  page?: number,
  limit?: number,
  search?: string,
  order?: string,
  orderDirection?: string,
  deleted?: string,
}

export class QueryParams implements IQueryParams {
  page: number;
  limit: number;
  search: string;
  order: string;
  orderDirection: string;
  deleted: string;

  constructor(params: IQueryParams) {
    this.page = params.page;
    this.limit = params.limit;
    this.search = params.search;
    this.order = params.order;
    this.orderDirection = params.orderDirection;
    this.deleted = params.deleted;
  }
}

export abstract class AbstractQueryComponent {

  public queryParams: QueryParams;
  protected readonly defaultQueryParams: IQueryParams = this.getDefaultQueryParams();
  public collectionSize = 1000000;  // if initial value is too small, default page will always be 1

  protected constructor(
    protected _ActivatedRoute: ActivatedRoute,
    protected _Router: Router,
  ) {
    this.queryParams = new QueryParams(this.defaultQueryParams);
    this.getRouteParams();
  }

  protected abstract getDefaultQueryParams(): IQueryParams;

  protected getRouteParams() {
    this._ActivatedRoute.queryParams.subscribe(params => {
      if (params.page) {
        this.queryParams.page = +params.page;
      }
      if (params.limit) {
        this.queryParams.limit = +params.limit;
      }
      if (params.search) {
        this.queryParams.search = params.search;
      }
      if (params.order) {
        this.queryParams.order = params.order;
      }
      if (params.orderDirection) {
        this.queryParams.orderDirection = params.orderDirection;
      }
      if (params.deleted) {
        this.queryParams.deleted = params.deleted;
      }
    });
  }

  protected syncQueryParams() {
    this._Router.navigate(['.'], {
      relativeTo: this._ActivatedRoute,
      queryParams: {
        page: this.queryParams.page === 0 || this.queryParams.page === 1 ? null : this.queryParams.page,
        limit: this.queryParams.limit === this.defaultQueryParams.limit ? null : this.queryParams.limit,
        search: this.queryParams.search === '' ? null : this.queryParams.search,
        order: this.queryParams.order === this.defaultQueryParams.order ? null : this.queryParams.order,
        orderDirection: this.queryParams.orderDirection === this.defaultQueryParams.orderDirection ? null : this.queryParams.orderDirection,
        deleted: this.queryParams.deleted === '0' ? null : this.queryParams.deleted,
      }
    }).then(r  =>{});
  }
}

export function queryString(queryParams: QueryParams): string {
  let symbol = '?';
  let query = '';
  let moreThanOne = false;

  for (const [key, value] of Object.entries(queryParams)) {

    if (value !== null && value !== undefined) {
      query += `${symbol}${key}=${value}`;
      moreThanOne = true;

      if (moreThanOne)
        symbol = '&'
    }
  }

  return query;
}
