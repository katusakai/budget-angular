import { Injectable } from '@angular/core';
import { BaseConfiguration } from "./base-configuration";
import { ConfigurationService } from "../admin/configuration.service";
import { GlobalConfigurationInterface } from "./global-configuration-interface";

@Injectable({
  providedIn: 'root'
})
export class GoogleLoginConfigurationService extends BaseConfiguration implements GlobalConfigurationInterface{

  constructor(
    private _Configuration: ConfigurationService,
    ) {
    super();
    this.setAccess();
  }

  public setAccess(): void {
    this._Configuration.show(3).subscribe(data => {
      this.access = data['data']['value'] === 'true';
    })
  }
}
