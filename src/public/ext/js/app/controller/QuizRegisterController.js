import { Validator } from "../../util/Validator.js";
export class QuizRegisterController {
    constructor() {
        this._fields = new Array();
        this._buttons = new Array();
        this._tables = new Array();
        this._modals = new Array();
        this._validator = new Validator();
        this._setElements();
        this._initializeListeners();
    }
    _setElements() {
        this._buttons['addItemBtn'] = document.getElementsByName('addItemBtn')[0];
        this._buttons['addItemModalAddBtn'] = document.getElementsByName('addItemModalAddBtn')[0];
        this._tables['itemTable'] = document.getElementsByName('itemTable')[0];
        this._modals['item-modal'] = document.getElementById("item-modal");
        this._modals['item-modal']['close-btn'] = document.getElementById('close-item-modal');
        this._fields['enunciation'] = document.getElementsByName('enunciation')[0];
        this._fields['enunciation']['helper'] = document.getElementsByName('enunciation-helper')[0];
    }
    _initializeListeners() {
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
//# sourceMappingURL=QuizRegisterController.js.map