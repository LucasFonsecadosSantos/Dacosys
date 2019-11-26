import { Validator } from "../../util/Validator.js";

export class ResearcherRegisterController {

    private _addTelephoneButton:    HTMLButtonElement;
    private _telephoneTable:        HTMLTableElement;
    private _fields:                Array<HTMLElement>;
    private _form:                  HTMLFormElement;
    private _validator:             Validator;

    constructor() {
        this._fields = new Array<HTMLElement>();
        this._validator = new Validator();
        this._setElements();
        this._initializeListeners();
    }

    private _setElements(): void {
        this._addTelephoneButton        = <HTMLButtonElement> document.getElementById('addTelBtn');
        this._telephoneTable            = <HTMLTableElement> document.getElementById('telephoneTable');
        this._form                      = <HTMLFormElement> document.getElementById('mainForm');
        this._fields['all_telephones']  = <HTMLTableElement> document.getElementsByName('allTelephones')[0];
        this._fields['id_person']       = <HTMLInputElement> document.getElementsByName('id_person')[0];
        this._fields['id_person']['helper'] = <HTMLInputElement> document.getElementsByName('id_person-helper')[0];
        this._fields['telephone']       = <HTMLInputElement> document.getElementsByName('telephone_add_field')[0];
        this._fields['telephone']['helper']       = <HTMLInputElement> document.getElementsByName('telephone_add_field-helper')[0];
        this._fields['typeRadio1']      = <HTMLInputElement> document.getElementsByName('type')[0];
        this._fields['typeRadio2']      = <HTMLInputElement> document.getElementsByName('type')[1];
        this._fields['id_person']       = <HTMLInputElement> document.getElementsByName('id_person')[0];
        this._fields['name']            = <HTMLInputElement> document.getElementsByName('name_person')[0];
        this._fields['name']['helper']  = <HTMLInputElement> document.getElementsByName('name-helper')[0];
        this._fields['hometown_cep']    = <HTMLInputElement> document.getElementsByName('hometown_cep')[0];
        this._fields['hometown_cep']['helper']    = <HTMLInputElement> document.getElementsByName('hometown_cep-helper')[0];
        this._fields['birth_day']       = <HTMLInputElement> document.getElementsByName('birth_day')[0];
        this._fields['color']           = <HTMLSelectElement> document.getElementsByName('color')[0];
        this._fields['sex']             = <HTMLSelectElement> document.getElementsByName('sex')[0];
        this._fields['email']           = <HTMLInputElement> document.getElementsByName('email')[0];
        this._fields['email']['helper']           = <HTMLInputElement> document.getElementsByName('email-helper')[0];
        this._fields['password']        = <HTMLInputElement> document.getElementsByName('password')[0];
        this._fields['password2']       = <HTMLInputElement> document.getElementsByName('password2')[0];

        this._fields.forEach(field => {
            (field as HTMLInputElement).value = "";
            console.log((field as HTMLInputElement).value);
        });
    }

    private _initializeListeners(): void {
        
        this._form.addEventListener('submit', event => {
            
            if (!this._validator.makeValidation(this._fields['name'], "REQUIRED|MAX_LENGTH:40|MIN_LENGTH:4")) {
                alert("erro");
                return false;
            }

            if (!this._validator.makeValidation(this._fields['email'], "EMAIL|REQUIRED|MAX_LENGTH:40|MIN_LENGTH:4")) {
                alert("erro");
                return false;
            }

            if (!this._validator.makeValidation(this._fields['hometown_cep'], "REQUIRED|MAX_LENGTH:9|MIN_LENGTH:9")) {
                alert("erro");
                return false;
            }

            if (this._fields['password'] =! this._fields['password2']) {
                alert("erro");
                return false;
            }

        });

        this._addTelephoneButton.addEventListener('click', event => {
            this._telephoneTable.innerHTML += "<tr><td><p>" + this._fields['telephone'].value + "</p></td></tr>";
            this._fields['all_telephones'].value += '@' + this._fields['telephone'].value;
            this._fields['telephone'].value = "";
        });

        this._fields['typeRadio1'].addEventListener('click', event => {
            if (this._fields['typeRadio1'].checked) {
                document.getElementById('id_person_row').classList.add('d-none');
            }
        });

        this._fields['typeRadio2'].addEventListener('click', event => {
            if (this._fields['typeRadio2'].checked) {
                document.getElementById('id_person_row').classList.remove('d-none');
            }
        });

        this._fields['name'].addEventListener('keydown', event => {
            this._fields['name']['helper'].textContent = "Você só pode digitar mais " + (40 - this._fields['name'].value.length) + " letras.";
        });

        this._fields['id_person'].addEventListener('keydown', event => {
            this._fields['id_person']['helper'].textContent = "Você só pode digitar mais " + (13 - this._fields['id_person'].value.length) + " letras/números.";
        });

        this._fields['hometown_cep'].addEventListener('keydown', event => {
            let fieldLength = this._fields['hometown_cep'].value.length;
            if (fieldLength == 5) {
                this._fields['hometown_cep'].value += '-';
            }
            this._fields['hometown_cep']['helper'].textContent = "Você só pode digitar mais " + (9 - fieldLength) + " números.";
        });

        this._fields['email'].addEventListener('keydown', event => {
            let fieldLength = this._fields['email'].value.length;
            this._fields['email']['helper'].textContent = "Você só pode digitar mais " + (40 - fieldLength) + " caracteres.";
        });

        this._fields['telephone'].addEventListener('keydown', event => {
            let fieldLength = this._fields['telephone'].value.length;
            if (fieldLength == 0) {
                this._fields['telephone'].value += '(';
            } else if (fieldLength == 3) {
                this._fields['telephone'].value += ') ';
            } else if (fieldLength == 4) {
                this._fields['telephone'].value += ' ';
            } else if (fieldLength == 10) {
                this._fields['telephone'].value += '-';
            }
            
            this._fields['telephone']['helper'].textContent = "Você só pode digitar mais " + (15 - fieldLength) + " números.";
        });

        this._fields['password2'].addEventListener('keydown', event => {
            if (this._fields['password2'].value.length == 0) {
                this._fields['password2']['helper'].textContent = "Digite sua senha novamente para confirmar";
            } else if (this._fields['password'].value != this._fields['password2'].value) {
                //this._fields['password2'].setCustomValidity('no');
                this._fields['password2']['helper'].textContent = "A confirmação de senha ainda não está correta!";

            } else {
                this._fields['password2']['helper'].textContent = "Senha confirmada!";
            }
        });
    }
}