import { Component, OnInit } from '@angular/core';
import { MoneyService } from '../../../services/budget/money.service';
import { Response } from '../../../models/response';
import { TotalMoney } from '../../../models/money/total-money';
import { Money } from '../../../models/money/money';
import { NgbModal } from '@ng-bootstrap/ng-bootstrap';
import { MoneyFormComponent } from './forms/money-form.component';

@Component({
  selector: 'app-money',
  templateUrl: './money.component.html',
  styleUrls: ['./money.component.scss']
})
export class MoneyComponent implements OnInit {

  public date: string;
  public money: [Money];
  public totalMoney: TotalMoney;
  public loading: boolean;

  constructor(
    private _money: MoneyService,
    private _modalService: NgbModal,
  ) { }

  ngOnInit(): void {
    this.loading = true;
    this.totalMoney = new TotalMoney();
    this.getThisMonth();
    this.getMonthStatistics();
  }

  getMonthStatistics() {
    this._money.getMonthly(this.date).subscribe((response: Response) => {
      this.money = response.data;
      this.getTotalMoney();
      this.loading = false;
    })
  }

  getThisMonth() {
    const date = new Date();
    const zeroBeforeMonth = date.getMonth() + 1 < 10 ? '0' : '';
    this.date = String(date.getFullYear()) + '-' + zeroBeforeMonth + String(date.getMonth()+1);
  }

  moneyCreateForm(){
    const modalRef = this._modalService.open(MoneyFormComponent);
  }

  getTotalMoney() {
    this.totalMoney.Income = 0;
    this.totalMoney.Expenses = 0;
    for (const spending of this.money) {
      if (spending.amount > 0) {
        this.totalMoney.Income += spending.amount;
      } else {
        this.totalMoney.Expenses += spending.amount;
      }
    }
  }
}
