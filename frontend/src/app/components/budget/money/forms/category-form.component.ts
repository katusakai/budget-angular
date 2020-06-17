import { Component, OnInit } from '@angular/core';

@Component({
  selector: 'app-category-form',
  templateUrl: './category-form.component.html',
  styleUrls: ['./category-form.component.scss']
})
export class CategoryFormComponent implements OnInit {

  form: any;
  message: string;

  constructor() { }

  ngOnInit(): void {
    this.form = {
      name: null,
      visualData: {title: null, button: null},
      method: null,
    }
  }

  formSubmit() {

  }

}
