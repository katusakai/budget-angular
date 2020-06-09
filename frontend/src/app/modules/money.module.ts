import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { RouterModule, Routes } from '@angular/router';
import { MoneyComponent } from '../components/budget/money/money.component';
import { AfterloginGuard} from '../guards/afterlogin.guard';
import { FormsModule } from '@angular/forms';

const  RouteList: Routes = [
  { path: 'monthly', component: MoneyComponent, canActivate: [AfterloginGuard] }
];

@NgModule({
  declarations: [
    MoneyComponent
  ],
  imports: [
    CommonModule,
    RouterModule.forRoot(RouteList),
    FormsModule
  ]
})
export class MoneyModule { }
