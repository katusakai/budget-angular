import { ConfigurationService } from '../admin/configuration.service';
import { Response } from '../../models/response';

export class BaseConfiguration {
  access: boolean;
  configId: number; // id database configurations table

  constructor(
    protected _Configuration: ConfigurationService,
  ) {}

  public setAccess(): void {
    this._Configuration.show(this.configId).subscribe((data: Response) => {
      this.access = data.data.value === 'true';
    })
  }
}
