enum Rule {
    REQUIRED        = 'REQUIRED',
    MIN_LENGTH      = 'MIN_LENGTH',
    MAX_LENGTH      = 'MAX_LENGTH',
    ONLY_LETTERS    = 'ONLY_LETTERS',
    ONLY_NUMBERS    = 'ONLY_NUMBERS',
    EMAIL           = 'EMAIL'
}

export class Validator {

    public static RULES: Rule;

    constructor() {

    }

    public makeValidation(field: HTMLInputElement, rules: string) {
        
        let rulesArray = this._getRulesAndValues(rules);

        for (let key in rulesArray) {
            
            switch (key) {
                case Rule.REQUIRED:
                    return (this._required(field)) ? [true,""] : [false,"Este campo é obrigatório."];
                    break;
                case Rule.MIN_LENGTH:
                    return (this._minLength(field, rulesArray[key])) ? [true,""] : [false,"Este campo deve possuir no mínimo " + rulesArray[key] + " caracteres."];
                    break;
                case Rule.MAX_LENGTH:
                    return (this._maxLength(field, rulesArray[key])) ? [true,""] : [false,"Este deve possuir no máximo " + rulesArray[key] + " caracteres."];
                    break;
                case Rule.ONLY_LETTERS:
                    return (this._onlyLetters(field)) ? [true,""] : [false,"Este campo deve possuir apenas letras."];
                    break;
                case Rule.ONLY_LETTERS:
                    return (this._onlyNumbers(field)) ? [true,""] : [false,"Este campo deve possuir apenas números."];
                    break;
                case Rule.EMAIL:
                    return (this._email(field)) ? [true,""] : [false,"Este campo deve um endereço de email válido."];
                    break;
            }
        }
    }
    
    private _email(field: HTMLInputElement): Boolean {
        let reg = /^(([^<>()\[\]\.,;:\s@\"]+(\.[^<>()\[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i;
        return (reg.test(field.value.toLowerCase()));
    }

    private _onlyNumbers(field: HTMLInputElement): Boolean {
        return /^[0-9]+$/.test(field.value);
    }

    private _onlyLetters(field: HTMLInputElement): Boolean {
        return /^[a-zA-Z]+$/.test(field.value);
    }

    private _maxLength(field: HTMLInputElement, length: number): Boolean {
        return (field.value.length <= length);
    }

    private _minLength(field: HTMLInputElement, length: number): Boolean {
        return (field.value.length >= length);
    }

    private _required(field: HTMLInputElement): Boolean {
        return ((field.value != "") && (field.value != null) && (field.value != undefined));
    }

    private _getRulesAndValues(rules) {
        rules = rules.split('|');
        let data = [];
        let rule;
        let value;
        rules.forEach(element => {
            rule = element.split(':')[0];
            value = element.split(':')[1];
            data[rule] = value;
        });
        return data;
    }
}