import { Component, Input, OnInit } from '@angular/core';
import { IConfiguration } from '../../../../models/configuration';
import { ConfigurationService } from '../../../../services/admin/configuration.service';

@Component({
  selector: 'app-true-false-configuration',
  templateUrl: './true-false-configuration.component.html',
  styleUrls: ['./true-false-configuration.component.scss']
})
export class TrueFalseConfigurationComponent implements OnInit {

  @Input() public label: string;
  @Input() public config: IConfiguration;
  public checked: boolean;

  constructor(
    private _Configuration: ConfigurationService,
  ) { }

  ngOnInit(): void {
    this.getData();
  }

  private getData(): void {
    this.checked = this.config.value === 'true';
  }

  public change(): void {
    let value = this.checked ? 'true': 'false';
    let data = {value: value};
    this._Configuration.update(this.config.id, data).subscribe(data => {
      //todo add response message
    })
  }

}
