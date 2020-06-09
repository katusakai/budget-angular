import {Component, Input, OnInit} from '@angular/core';
import { Money } from '../../../../models/money/money';

@Component({
  selector: 'app-money-table',
  templateUrl: './table.component.html',
  styleUrls: ['./table.component.scss']
})
export class TableComponent implements OnInit {

  @Input() public money: [Money];

  constructor() { }

  ngOnInit(): void {
  }

  classIncomeExpanses(value) {
    return value > 0 ? 'income-color' : 'expanses-color'
  }

  moneyEditForm(spending){
    // this.$root.$emit('editMoney', spending);
  }

}
