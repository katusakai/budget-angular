import { Injectable } from '@angular/core';
import { BaseConfiguration } from './base-configuration';
import { GlobalConfigurationInterface } from './global-configuration-interface';
import { ConfigurationService } from '../admin/configuration.service';

@Injectable({
  providedIn: 'root'
})
export class FacebookLoginConfigurationService  extends BaseConfiguration implements GlobalConfigurationInterface{

  configId = 4;

  constructor(
    protected _Configuration: ConfigurationService,
  ) {
    super(_Configuration);
    this.setAccess();
  }
}
