import { Injectable } from '@angular/core';
import { BaseConfiguration } from "./base-configuration";
import { GlobalConfigurationInterface } from "./global-configuration-interface";
import { ConfigurationService } from "../admin/configuration.service";

@Injectable({
  providedIn: 'root'
})
export class FacebookLoginConfigurationService  extends BaseConfiguration implements GlobalConfigurationInterface{

  constructor(
    private _Configuration: ConfigurationService,
  ) {
    super();
    this.setAccess();
  }

  public setAccess(): void {
    this._Configuration.show(4).subscribe(data => {
      this.access = data['data']['value'] === 'true';
    })
  }
}
