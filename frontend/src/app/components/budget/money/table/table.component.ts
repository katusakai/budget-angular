import { Component, Input, OnInit } from '@angular/core';
import { Money } from '../../../../models/money/money';
import { MoneyFormComponent } from '../forms/money-form.component';
import { NgbModal } from '@ng-bootstrap/ng-bootstrap';

@Component({
  selector: 'app-money-table',
  templateUrl: './table.component.html',
  styleUrls: ['./table.component.scss']
})
export class TableComponent implements OnInit {

  @Input() public money: [Money];

  constructor(
    private _modalService: NgbModal,
  ) { }

  ngOnInit(): void {
  }

  classIncomeExpanses(value) {
    return value > 0 ? 'income-color' : 'expanses-color'
  }

  moneyEditForm(spending){
    if(this._modalService.hasOpenModals())
      this._modalService.dismissAll();

    const modalRef = this._modalService.open(MoneyFormComponent);
    modalRef.componentInstance.callType = 'update';
    modalRef.componentInstance.spending = spending;
  }

}
