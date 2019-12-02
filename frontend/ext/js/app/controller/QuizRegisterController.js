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
        this._tables['item-table'] = document.getElementsByName('itemTable')[0];
        this._modals['item-modal'] = document.getElementById("item-modal");
        this._modals['item-modal']['close-btn'] = document.getElementById('close-item-modal');
        this._fields['enunciation'] = document.getElementsByName('enunciation')[0];
        this._fields['enunciation']['helper'] = document.getElementsByName('enunciation-helper')[0];
        this._fields['answer_type'] = document.getElementsByName('answer_type')[0];
        this._fields['answer_image'] = document.getElementsByName('answer_image')[0];
    }
    _initializeListeners() {
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
            this._tables['item-table'].appendChild(this._getModalItems());
        });
        this._fields['answer_type'].addEventListener('change', event => {
            if ((this._fields['answer_type'].value == '_DISCRET_') || (this._fields['answer_type'].value == '_CONTINUOS_')) {
                document.getElementById('add-image-row').classList.remove('d-none');
                document.getElementById('add-image-button-container').classList.remove('d-none');
            }
            else {
                document.getElementById('add-image-row').classList.add('d-none');
                document.getElementById('add-image-button-container').classList.add('d-none');
            }
        });
        this._fields['answer_image'].addEventListener('change', event => {
            let files = this._fields['answer_image'].files;
            let containerDiv;
            let inputOptionValue;
            let hiddenInputOptionValue;
            let img;
            if (this._verifyImageLimit(files)) {
                let count = 0;
                Array.from(files).forEach(element => {
                    img = document.createElement("IMG");
                    hiddenInputOptionValue = document.createElement('INPUT');
                    hiddenInputOptionValue.setAttribute('type', 'hidden');
                    hiddenInputOptionValue.setAttribute('name', 'option-' + count + '-path');
                    img.classList.add("mt-3");
                    img.setAttribute('src', URL.createObjectURL(this._fields['answer_image'].files[count]));
                    containerDiv = document.createElement("DIV");
                    containerDiv.classList.add("col-12", "col-sm-6", "col-md-3", "col-lg-3", "col-xl-3", "item-image-container", "d-flex", "flex-column", "justify-content-center");
                    inputOptionValue = document.createElement('INPUT');
                    inputOptionValue.setAttribute('placeholder', 'Valor da opção');
                    inputOptionValue.setAttribute('width', '90%');
                    inputOptionValue.setAttribute('name', 'option-value-' + count);
                    inputOptionValue.classList.add('mt-1');
                    containerDiv.appendChild(img);
                    containerDiv.appendChild(hiddenInputOptionValue);
                    containerDiv.appendChild(inputOptionValue);
                    document.getElementById('add-image-row').appendChild(containerDiv);
                    count++;
                });
            }
            else {
                alert("implementar aqui");
            }
        });
        this._fields['answer_image'].addEventListener('click', event => {
            this._fields['answer_image'].value = "";
        });
    }
    _getModalItems() {
        let row = document.createElement('TR');
        let images = document.createElement('INPUT');
        let cell1 = document.createElement('TD');
        let cell2 = document.createElement('TD');
        let cell3 = document.createElement('TD');
        let p;
        //row.setAttribute('value','ENUNCIATION=' + )
        images.setAttribute('type', 'hidden');
        images.setAttribute('value', this._getModalImageOptions());
        row.addEventListener('click', event => {
            alert("Em implementação.");
        });
        p = document.createElement('P');
        p.classList.add('white-color');
        cell1.classList.add('white-color');
        cell1.textContent = this._fields['enunciation'].value;
        p.textContent = this._fields['answer_type'].value;
        cell2.classList.add('white-color');
        cell2.textContent = this._fields['answer_type'].value;
        let actionIcon1 = document.createElement('I');
        let actionIcon2 = document.createElement('I');
        let actionIcon3 = document.createElement('I');
        actionIcon1.classList.add("material-icons", "white-color");
        actionIcon2.classList.add("material-icons", "white-color");
        actionIcon3.classList.add("material-icons", "white-color");
        actionIcon1.textContent = 'edit';
        actionIcon2.textContent = 'remove_red_eye';
        actionIcon3.textContent = 'delete';
        actionIcon1.setAttribute('title', 'Clique para editar este item.');
        actionIcon1.setAttribute('title', 'Clique para visualizar este item.');
        actionIcon1.setAttribute('title', 'Clique para remover este item.');
        actionIcon1.setAttribute('alt', 'Botão para editar este item.');
        actionIcon1.setAttribute('alt', 'Botão para visualizar este item.');
        actionIcon1.setAttribute('alt', 'Botão para remover este item.');
        cell3.classList.add('d-flex', 'justify-content-end', 'align-items-center');
        cell3.appendChild(actionIcon1);
        cell3.appendChild(actionIcon2);
        cell3.appendChild(actionIcon3);
        row.appendChild(images);
        row.appendChild(cell1);
        row.appendChild(cell2);
        row.appendChild(cell3);
        return row;
    }
    _getModalImageOptions() {
        let finalStr = "";
        document.getElementById('add-image-row').childNodes.forEach(element => {
            finalStr += element.childNodes[0].src + '&' + element.childNodes[2].value + '@';
        });
        return finalStr.replace(/.$/, "");
    }
    _verifyImageLimit(filesArray) {
        if (this._fields['answer_type'].value == '_DISCRET_') {
            //from 5 to 9
            return ((document.getElementById('add-image-row').childNodes.length + filesArray.length) < 10);
        }
        else if (this._fields['answer_type'].value == '_CONTINUOS_') {
            //just 3 elements
            return ((document.getElementById('add-image-row').childNodes.length + filesArray.length) < 4);
        }
    }
}
//# sourceMappingURL=QuizRegisterController.js.map