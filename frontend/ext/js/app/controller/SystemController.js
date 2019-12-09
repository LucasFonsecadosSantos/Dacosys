export class SystemController {
    constructor() {
        this._initializeComponents();
        this._initializeListeners();
    }
    _initializeComponents() {
        this._alertModal = document.getElementsByClassName('alert');
    }
    _initializeListeners() {
        Array.from(this._alertModal).forEach(element => {
            element.childNodes[2].addEventListener('click', event => {
                event.target.parentNode.classList.add('d-none');
                event.target.parentNode.classList.remove('d-flex');
            });
        });
    }
}
//# sourceMappingURL=SystemController.js.map