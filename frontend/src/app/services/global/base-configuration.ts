import { ConfigurationService } from "../admin/configuration.service";

export class BaseConfiguration {
  access: boolean;
  configId: number; // id database configurations table

  constructor(
    protected _Configuration: ConfigurationService,
  ) {}

  public setAccess(): void {
    this._Configuration.show(this.configId).subscribe(data => {
      this.access = data['data']['value'] === 'true';
    })
  }
}
