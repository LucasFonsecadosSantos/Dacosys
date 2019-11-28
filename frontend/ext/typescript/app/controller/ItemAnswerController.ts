import { Validator } from "../../util/Validator.js";

export class ItemAnswerController {

    private _validator:         Validator;
    private _storeAnswerButton: HTMLButtonElement;
    private _nextItemButton:    HTMLAnchorElement;
    private _fields:            Array<HTMLElement>;
    private _options:           HTMLCollectionOf<Element>;
    private _form:              HTMLFormElement;

    constructor() {
        this._fields = new Array<HTMLElement>();
        this._validator = new Validator();
        this._setElements();
        this._initializeListeners();
    }

    private _setElements(): void {
        this._nextItemButton    = <HTMLAnchorElement> document.getElementById('nextBtn');
        this._storeAnswerButton = <HTMLButtonElement> document.getElementById('storeBtn');
        this._fields['answer']  = <HTMLInputElement> document.getElementsByName('answer')[0];
        this._options           = <HTMLCollectionOf<Element>> document.getElementsByClassName('item-option');
    }

    private _initializeListeners(): void {
        
        this._form.addEventListener('submit', event => {
            
            
        });

        this._storeAnswerButton.addEventListener('click', event => {
            this._nextItemButton.classList.remove('d-none');
        });
        
    }
}