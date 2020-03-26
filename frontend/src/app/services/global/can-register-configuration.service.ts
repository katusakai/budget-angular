import { Injectable } from '@angular/core';
import { BaseConfiguration } from "./base-configuration";
import { ConfigurationService } from "../admin/configuration.service";
import { GlobalConfigurationInterface } from "./global-configuration-interface";

@Injectable({
  providedIn: 'root'
})
export class CanRegisterConfigurationService extends BaseConfiguration implements GlobalConfigurationInterface{

  constructor(
    private _Configuration: ConfigurationService,
  ) {
    super();
    this.setAccess();
  }

  public setAccess(): void {
    this._Configuration.show(1).subscribe(data => {
      this.access = data['data']['value'] === 'true';
    })
  }
}
