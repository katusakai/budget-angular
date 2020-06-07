import { Injectable } from '@angular/core';
import { BaseConfiguration } from './base-configuration';
import { ConfigurationService } from '../admin/configuration.service';
import { GlobalConfigurationInterface } from './global-configuration-interface';

@Injectable({
  providedIn: 'root'
})
export class CanRegisterConfigurationService extends BaseConfiguration implements GlobalConfigurationInterface{

  configId = 1;

  constructor(
    protected _Configuration: ConfigurationService,
  ) {
    super(_Configuration);
    this.setAccess()
  }
}
