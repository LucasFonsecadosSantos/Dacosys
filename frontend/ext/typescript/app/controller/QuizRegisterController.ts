import { Validator } from "../../util/Validator.js";

export class QuizRegisterController {

    private _buttons:   Array<HTMLButtonElement>;
    private _tables:    Array<HTMLTableElement>;
    private _modals:    Array<HTMLElement>;
    private _fields:    Array<HTMLElement>;
    private _form:      HTMLFormElement;
    private _validator: Validator;

    constructor() {
        this._fields    = new Array<HTMLElement>();
        this._buttons   = new Array<HTMLButtonElement>();
        this._tables    = new Array<HTMLTableElement>();
        this._modals    = new Array<HTMLDivElement>();
        this._validator = new Validator();
        this._setElements();
        this._initializeListeners();
    }

    private _setElements(): void {
        this._buttons['addItemBtn'] = <HTMLButtonElement> document.getElementsByName('addItemBtn')[0];
        this._buttons['addItemModalAddBtn'] = <HTMLButtonElement> document.getElementsByName('addItemModalAddBtn')[0];
        this._tables['itemTable']   = <HTMLTableElement> document.getElementsByName('itemTable')[0];
        this._modals['item-modal'] = <HTMLDivElement> document.getElementById("item-modal");
        this._modals['item-modal']['close-btn'] = <HTMLSpanElement> document.getElementById('close-item-modal');
        this._fields['enunciation'] = <HTMLInputElement> document.getElementsByName('enunciation')[0];
        this._fields['enunciation']['helper'] = <HTMLParagraphElement> document.getElementsByName('enunciation-helper')[0];
    }

    private _initializeListeners(): void {
        
        // this._form.addEventListener('submit', event => {
            
        //     if (!this._validator.makeValidation(this._fields['name'], "REQUIRED|MAX_LENGTH:40|MIN_LENGTH:4")) {
        //         alert("erro");
        //         return false;
        //     }

        //     if (!this._validator.makeValidation(this._fields['email'], "EMAIL|REQUIRED|MAX_LENGTH:40|MIN_LENGTH:4")) {
        //         alert("erro");
        //         return false;
        //     }

        //     if (!this._validator.makeValidation(this._fields['hometown_cep'], "REQUIRED|MAX_LENGTH:9|MIN_LENGTH:9")) {
        //         alert("erro");
        //         return false;
        //     }

        //     if (this._fields['password'] =! this._fields['password2']) {
        //         alert("erro");
        //         return false;
        //     }

        // });

        this._buttons['addItemBtn'].addEventListener('click', event => {
            this._modals['item-modal'].classList.remove('d-none');
            this._modals['item-modal'].classList.add('d-block');
        });

        this._modals['item-modal']['close-btn'].addEventListener('click', event => {
            this._modals['item-modal'].classList.add('d-none');
            this._modals['item-modal'].classList.remove('d-block');
        });

        this._fields['enunciation'].addEventListener('keydown', event => {
            this._fields['enunciation']['helper'].textContent = "Você só pode digitar mais " + (150 - this._fields['enunciation'].value.length) + " números.";
        });

        this._buttons['addItemModalAddBtn'].addEventListener('click', event => {
            this._modals['item-modal'].classList.add('d-none');
            this._modals['item-modal'].classList.remove('d-block');
        });

    }
}