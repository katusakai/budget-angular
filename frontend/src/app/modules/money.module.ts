import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { RouterModule, Routes } from '@angular/router';
import { FormsModule } from '@angular/forms';

import { AfterloginGuard} from '../guards/afterlogin.guard';
import { PlusPipe } from '../pipes/plus.pipe';

import { MoneyComponent } from '../components/budget/money/money.component';
import { TableComponent } from '../components/budget/money/table/table.component';
import { MoneyFormComponent } from '../components/budget/money/forms/money-form.component';

const  RouteList: Routes = [
  { path: 'monthly', component: MoneyComponent, canActivate: [AfterloginGuard] }
];

@NgModule({
  declarations: [
    MoneyComponent,
    TableComponent,
    PlusPipe,
    MoneyFormComponent,
  ],
  imports: [
    CommonModule,
    RouterModule.forRoot(RouteList),
    FormsModule,
  ],
})
export class MoneyModule { }
