export class ParticipantRegisterController {
    constructor() {
        this._fields = new Array();
        this._setElements();
        this._initializeListeners();
    }
    _setElements() {
        this._addTelephoneButton = document.getElementById('addTelBtn');
        this._telephoneTable = document.getElementById('telephoneTable');
        this._fields['id_person'] = document.getElementsByName('id_person')[0];
        this._fields['id_person']['helper'] = document.getElementsByName('id_person-helper')[0];
        this._fields['telephone'] = document.getElementsByName('telephone_add_field')[0];
        this._fields['telephone']['helper'] = document.getElementsByName('telephone_add_field-helper')[0];
        this._fields['typeRadio1'] = document.getElementsByName('type')[0];
        this._fields['typeRadio2'] = document.getElementsByName('type')[1];
        this._fields['id_person'] = document.getElementsByName('id_person')[0];
        this._fields['name'] = document.getElementsByName('name')[0];
        this._fields['name']['helper'] = document.getElementsByName('name-helper')[0];
        this._fields['hometown_cep'] = document.getElementsByName('hometown_cep')[0];
        this._fields['hometown_cep']['helper'] = document.getElementsByName('hometown_cep-helper')[0];
        this._fields['birth_day'] = document.getElementsByName('birth_day')[0];
        this._fields['color'] = document.getElementsByName('color')[0];
        this._fields['sex'] = document.getElementsByName('sex')[0];
        this._fields['email'] = document.getElementsByName('email')[0];
        this._fields['email']['helper'] = document.getElementsByName('email-helper')[0];
        this._fields['password'] = document.getElementsByName('password')[0];
        this._fields['password2'] = document.getElementsByName('password2')[0];
    }
    _initializeListeners() {
        this._addTelephoneButton.addEventListener('click', event => {
            this._telephoneTable.classList.remove('d-none');
            this._telephoneTable.innerHTML += "<tr><td><p>" + this._fields['telephone'].value + "</p></td></tr>";
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
            }
            else if (fieldLength == 3) {
                this._fields['telephone'].value += ') ';
            }
            else if (fieldLength == 4) {
                this._fields['telephone'].value += ' ';
            }
            else if (fieldLength == 10) {
                this._fields['telephone'].value += '-';
            }
            this._fields['telephone']['helper'].textContent = "Você só pode digitar mais " + (15 - fieldLength) + " números.";
        });
    }
}
//# sourceMappingURL=ParticipantRegisterController.js.map