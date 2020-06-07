import { Component, OnInit } from '@angular/core';
import { ConfigurationService } from '../../../services/admin/configuration.service';
import { IConfiguration } from '../../../models/configuration';

@Component({
  selector: 'app-configuration',
  templateUrl: './configuration.component.html',
  styleUrls: ['./configuration.component.scss']
})
export class ConfigurationComponent implements OnInit {

  public configs: IConfiguration[];

  constructor(
    private _Configuration: ConfigurationService,
  ) { }

  ngOnInit(): void {
    this.getAll();
  }

  private getAll() {
    this._Configuration.index().subscribe(data => {
      this.configs = data['data'];
    })
  }
}
