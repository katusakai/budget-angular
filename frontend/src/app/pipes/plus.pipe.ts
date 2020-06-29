import { Pipe, PipeTransform } from '@angular/core';

@Pipe({
  name: 'plus'
})
export class PlusPipe implements PipeTransform {

  transform(value: number): string {
    return value > 0 ? `+${value.toFixed(2)}` : `${value.toFixed(2)}`;
  }

}
