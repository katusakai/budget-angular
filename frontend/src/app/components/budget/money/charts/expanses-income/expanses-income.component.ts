import { Component, Input, OnInit } from '@angular/core';
import { ChartType } from 'angular-google-charts';

@Component({
  selector: 'app-expanses-income',
  templateUrl: './expanses-income.component.html',
  styleUrls: ['./expanses-income.component.scss']
})
export class ExpansesIncomeComponent implements OnInit {

  @Input() money;
  @Input() dataType;

  type: string;
  data: any[];
  options: any;
  columnNames: any[];

  constructor() { }

  ngOnInit(): void {

    this.type = ChartType.BarChart;
    this.data = [];
    this.options = {
      legend: {position: 'none'},
      subtitle: '',
      is3D: true,
      chart: {},
      chartArea: {top: 0}
    };
    this.columnNames = ['Category', 'Amount', {role: 'style'}];

    this.setChartData();
  }

  setChartData() {
    switch (this.dataType) {
      case 'expenses':
        this.setDataForExpenses();
        break;
      case 'income':
        this.setDataForIncome();
        break;
    }
  };

  setDataForExpenses () {
    for (let i = 0; i < this.money.length; i++) {
      if (this.money[i].amount >= 0) {
        continue;
      }
      let ifDone = false;
      for(let k = 0; k < this.data.length; k++){
        if (this.data[k].includes(this.money[i].category_name)) {
          this.data[k][1] += (this.money[i].amount * -1);
          ifDone = true;
          break;
        }
      }
      if (!ifDone) {
        const row = [this.money[i].category_name, (this.money[i].amount * -1), 'red'];
        this.data.push(row);
      }
    }
  };

  setDataForIncome() {
      for (let i = 0; i < this.money.length; i++) {
        if (this.money[i].amount < 0) {
          continue;
        }
        let ifDone = false;
        for(let k = 0; k < this.data.length; k++){
          if (this.data[k].includes(this.money[i].category_name)) {
            this.data[k][1] += this.money[i].amount;
            ifDone = true;
            break;
          }
        }
        if (!ifDone) {
          const row = [this.money[i].category_name, this.money[i].amount, 'green'];
          this.data.push(row);
        }
      }
  };

}
