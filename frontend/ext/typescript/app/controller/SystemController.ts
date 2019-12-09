export class SystemController {

    private _alertModal: HTMLCollection;

    constructor() {
        this._initializeComponents();
        this._initializeListeners();
    }

    private _initializeComponents() {
        this._alertModal = document.getElementsByClassName('alert');
    }

    private _initializeListeners() {
        
        Array.from(this._alertModal).forEach(element => {
            
            element.childNodes[2].addEventListener('click', event => {
                ((event.target as HTMLDivElement).parentNode as HTMLDivElement).classList.add('d-none');
                ((event.target as HTMLDivElement).parentNode as HTMLDivElement).classList.remove('d-flex');
            });
        
        });
    
    }

}