import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { RouterModule, Routes } from '@angular/router';
import { FormsModule, ReactiveFormsModule } from '@angular/forms';

import { AfterloginGuard} from '../guards/afterlogin.guard';
import { PlusPipe } from '../pipes/plus.pipe';

import { MoneyComponent } from '../components/budget/money/money.component';
import { TableComponent } from '../components/budget/money/table/table.component';
import { MoneyFormComponent } from '../components/budget/money/forms/money-form.component';
import { SubcategoryFormComponent } from '../components/budget/money/forms/subcategory-form.component';
import { CategoryFormComponent } from '../components/budget/money/forms/category-form.component';

const  RouteList: Routes = [
  { path: 'monthly', component: MoneyComponent, canActivate: [AfterloginGuard] }
];

@NgModule({
  declarations: [
    MoneyComponent,
    TableComponent,
    PlusPipe,
    MoneyFormComponent,
    SubcategoryFormComponent,
    CategoryFormComponent,
  ],
  imports: [
    CommonModule,
    RouterModule.forRoot(RouteList),
    FormsModule,
    ReactiveFormsModule,
  ],
})
export class MoneyModule { }
