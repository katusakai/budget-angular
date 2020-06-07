import { Injectable } from '@angular/core';
import { BaseConfiguration } from './base-configuration';
import { ConfigurationService } from '../admin/configuration.service';
import { GlobalConfigurationInterface } from './global-configuration-interface';

@Injectable({
  providedIn: 'root'
})
export class GoogleLoginConfigurationService extends BaseConfiguration implements GlobalConfigurationInterface{

  configId = 3;

  constructor(
    protected _Configuration: ConfigurationService,
    ) {
    super(_Configuration);
    this.setAccess()
  }
}
