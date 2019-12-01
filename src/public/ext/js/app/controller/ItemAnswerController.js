import { Validator } from "../../util/Validator.js";
export class ItemAnswerController {
    constructor() {
        this._fields = new Array();
        this._validator = new Validator();
        this._setElements();
        this._initializeListeners();
    }
    _setElements() {
        this._nextItemButton = document.getElementById('nextBtn');
        this._storeAnswerButton = document.getElementById('storeBtn');
        this._fields['answer'] = document.getElementsByName('answer')[0];
        this._options = document.getElementsByClassName('item-option');
    }
    _initializeListeners() {
        this._form.addEventListener('submit', event => {
        });
        this._storeAnswerButton.addEventListener('click', event => {
            this._nextItemButton.classList.remove('d-none');
        });
    }
}
//# sourceMappingURL=ItemAnswerController.js.map