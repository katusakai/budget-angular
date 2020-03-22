import { Injectable } from '@angular/core';
import { BaseConfiguration } from "./base-configuration";
import { ConfigurationService } from "../admin/configuration.service";

@Injectable({
  providedIn: 'root'
})
export class GoogleLoginConfigurationService extends BaseConfiguration {

  constructor(
    private _Configuration: ConfigurationService,
    ) {
    super();
    this.setAccess();
  }

  public setAccess() {
    this._Configuration.show(3).subscribe(data => {
      this.access = data['data']['value'] === 'true';
    })
  }
}
