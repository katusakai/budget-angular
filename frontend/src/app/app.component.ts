import { Component, OnInit } from '@angular/core';
import { environment } from '../environments/environment';
import { Title } from '@angular/platform-browser';

@Component({
  selector: 'app-root',
  templateUrl: './app.component.html',
  styleUrls: ['./app.component.scss']
})
export class AppComponent implements OnInit {
  constructor(
      private TitleService: Title,
  ) {
  }

  ngOnInit() {
    this.TitleService.setTitle(environment.appName);
  }
}
