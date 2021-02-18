import { Component, Input, OnChanges } from '@angular/core';
import { ChartType } from 'angular-google-charts';

@Component({
  selector: 'app-expanses-income',
  templateUrl: './expanses-income.component.html',
  styleUrls: ['./expanses-income.component.scss']
})
export class ExpansesIncomeComponent implements OnChanges  {

  @Input() money;
  @Input() dataType;

  type: string;
  data: any[];
  options: any;
  columnNames: any[];

  constructor() { }

  ngOnChanges(): void {
    
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

  private setChartData(): void {
    switch (this.dataType) {
      case 'expenses':
        this.setDataForExpenses();
        break;
      case 'income':
        this.setDataForIncome();
        break;
    }
  };

  private setDataForExpenses(): void {
    for(const spending of this.money) {
      if (spending.amount >= 0) {
        continue;
      }
      let ifDone = false;

      for(const sum of this.data) {
        if (sum.includes(spending.category_name)) {
          sum[1] += (spending.amount * -1);
          ifDone = true;
          break;
        }
      }
      if (!ifDone) {
        const row = [spending.category_name, (spending.amount * -1), 'red'];
        this.data.push(row);
      }
    }
  };

  private setDataForIncome(): void {
    for(const spending of this.money) {
      if (spending.amount < 0) {
        continue;
      }
      let ifDone = false;

      for(const sum of this.data) {
        if (sum.includes(spending.category_name)) {
          sum[1] += spending.amount;
          ifDone = true;
          break;
        }
      }
      if (!ifDone) {
        const row = [spending.category_name, spending.amount, 'green'];
        this.data.push(row);
      }
    }
  };

}
