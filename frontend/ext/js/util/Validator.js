var Rule;
(function (Rule) {
    Rule["REQUIRED"] = "REQUIRED";
    Rule["MIN_LENGTH"] = "MIN_LENGTH";
    Rule["MAX_LENGTH"] = "MAX_LENGTH";
    Rule["ONLY_LETTERS"] = "ONLY_LETTERS";
    Rule["ONLY_NUMBERS"] = "ONLY_NUMBERS";
    Rule["EMAIL"] = "EMAIL";
})(Rule || (Rule = {}));
export class Validator {
    constructor() {
    }
    makeValidation(field, rules) {
        let rulesArray = this._getRulesAndValues(rules);
        for (let key in rulesArray) {
            switch (key) {
                case Rule.REQUIRED:
                    return (this._required(field)) ? [true, ""] : [false, "Este campo é obrigatório."];
                    break;
                case Rule.MIN_LENGTH:
                    return (this._minLength(field, rulesArray[key])) ? [true, ""] : [false, "Este campo deve possuir no mínimo " + rulesArray[key] + " caracteres."];
                    break;
                case Rule.MAX_LENGTH:
                    return (this._maxLength(field, rulesArray[key])) ? [true, ""] : [false, "Este deve possuir no máximo " + rulesArray[key] + " caracteres."];
                    break;
                case Rule.ONLY_LETTERS:
                    return (this._onlyLetters(field)) ? [true, ""] : [false, "Este campo deve possuir apenas letras."];
                    break;
                case Rule.ONLY_LETTERS:
                    return (this._onlyNumbers(field)) ? [true, ""] : [false, "Este campo deve possuir apenas números."];
                    break;
                case Rule.EMAIL:
                    return (this._email(field)) ? [true, ""] : [false, "Este campo deve um endereço de email válido."];
                    break;
            }
        }
    }
    _email(field) {
        let reg = /^(([^<>()\[\]\.,;:\s@\"]+(\.[^<>()\[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i;
        return (reg.test(field.value.toLowerCase()));
    }
    _onlyNumbers(field) {
        return /^[0-9]+$/.test(field.value);
    }
    _onlyLetters(field) {
        return /^[a-zA-Z]+$/.test(field.value);
    }
    _maxLength(field, length) {
        return (field.value.length <= length);
    }
    _minLength(field, length) {
        return (field.value.length >= length);
    }
    _required(field) {
        return ((field.value != "") && (field.value != null) && (field.value != undefined));
    }
    _getRulesAndValues(rules) {
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
//# sourceMappingURL=Validator.js.map