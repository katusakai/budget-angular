import { Subject } from "rxjs";

export abstract class AbstractModelService {

    public $reload = new Subject();
}