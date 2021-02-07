import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { GoogleChartsModule } from 'angular-google-charts';
import { ExpansesIncomeComponent } from '../components/budget/money/charts/expanses-income/expanses-income.component';



@NgModule({
  declarations: [
    ExpansesIncomeComponent,
  ],
  imports: [
    CommonModule,
    GoogleChartsModule,
  ],
  exports: [
    ExpansesIncomeComponent
  ]
})
export class AppChartModule { }
