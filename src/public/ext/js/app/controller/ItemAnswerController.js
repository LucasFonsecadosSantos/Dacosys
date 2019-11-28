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
    }
    _initializeListeners() {
        this._form.addEventListener('submit', event => {
        });
        this._storeAnswerButton.addEventListener('click', event => {
            this._nextItemButton.classList.remove('d-none');
        });
        // @ts-ignore
        document.getElementsByTagName('input').forEach(element => {
            element.addEventListener('change', event => {
                this._fields['answer'].value = event.target.value;
                alert('asdad');
            });
        });
    }
}
//# sourceMappingURL=ItemAnswerController.js.map