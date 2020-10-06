import { Component, OnInit} from '@angular/core';
import { NgbModal } from '@ng-bootstrap/ng-bootstrap';

export class ModalProperties {
  title?: string;
  form?: {
    name: string,
    callType: string  | 'Create' | 'Update';
  }
}

@Component({
  selector: 'app-modal',
  templateUrl: './modal.component.html',
  styleUrls: ['./modal.component.scss']
})
export class ModalComponent implements OnInit {

  properties: ModalProperties = new ModalProperties();

  constructor(
    private _modalService: NgbModal,
  ) { }

  ngOnInit(): void {
  }

  public dismiss(reason?: string) {
    this._modalService.dismissAll(reason);
  }
}
