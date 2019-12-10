import { Validator } from "../../util/Validator.js";

export class QuizRegisterController {

    private _buttons:   Array<HTMLButtonElement>;
    private _tables:    Array<HTMLTableElement>;
    private _modals:    Array<HTMLElement>;
    private _fields:    Array<HTMLElement>;
    private _form:      HTMLFormElement;
    private _validator: Validator;
    private _sharedFields: Array<HTMLInputElement>;
    private _itemNumber: number;

    constructor() {
        this._fields    = new Array<HTMLElement>();
        this._buttons   = new Array<HTMLButtonElement>();
        this._tables    = new Array<HTMLTableElement>();
        this._modals    = new Array<HTMLDivElement>();
        this._sharedFields = new Array<HTMLInputElement>();
        this._validator = new Validator();
        this._itemNumber = 0;
        this._setElements();
        this._initializeListeners();
    }

    private _setElements(): void {
        this._buttons['addItemBtn']             = <HTMLButtonElement> document.getElementsByName('addItemBtn')[0];
        this._buttons['generate-access-key']    = <HTMLButtonElement> document.getElementsByName('generateAccessKey')[0];
        this._buttons['addItemModalAddBtn']     = <HTMLButtonElement> document.getElementsByName('addItemModalAddBtn')[0];
        this._tables['item-table']               = <HTMLTableElement> document.getElementsByName('itemTable')[0];
        this._tables['accessKeyTable']          = <HTMLTableElement> document.getElementsByName('accessKeyTable')[0];
        this._modals['item-modal']              = <HTMLDivElement> document.getElementById("item-modal");
        this._modals['item-modal']['close-btn'] = <HTMLSpanElement> document.getElementById('close-item-modal');
        this._fields['enunciation']             = <HTMLInputElement> document.getElementsByName('enunciation')[0];
        this._fields['enunciation']['helper']   = <HTMLParagraphElement> document.getElementsByName('enunciation-helper')[0];
        this._fields['answer_type']             = <HTMLSelectElement> document.getElementsByName('answer_type')[0];
        this._fields['answer_image']            = <HTMLInputElement> document.getElementsByName('answer_image')[0];
        this._fields['token_amount']            = <HTMLInputElement> document.getElementsByName('token_amount')[0];
        this._fields['item_answerEnunciation'] = <HTMLInputElement> document.getElementsByName('item_answerEnunciation')[0];
        this._fields['item_answerType'] = <HTMLInputElement> document.getElementsByName('item_answerType')[0];
        this._fields['item_answerImages'] = <HTMLInputElement> document.getElementsByName('item_answerImages')[0];
    }

    private _initializeListeners(): void {

        this._buttons['addItemBtn'].addEventListener('click', event => {
            
            this._modals['item-modal'].classList.remove('d-none');
            this._modals['item-modal'].classList.add('d-block');

        });

        this._buttons['generate-access-key'].addEventListener('click', event => {

            let row = this._tables['accessKeyTable'].insertRow(0);
            let cell1 = row.insertCell(0);
            let cell2 = row.insertCell(1);

            cell1.classList.add('white-color');
            cell1.textContent = "Este token de acesso estará disponivel após a conclusão do registro deste questionário.";

            cell2.classList.add('white-color');
            cell2.innerHTML = '<i class="material-icons">delete</i>';

            let amount = parseInt(this._fields['token_amount'].value);
            amount += 1;
            this._fields["token_amount"].value = "" + amount;

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
            
            let importedImagesCells = document.getElementById('continuos_options').childNodes;
            importedImagesCells.forEach(element => {
                alert(element);
                (element as HTMLDivElement).classList.add('d-none');
                (element as HTMLDivElement).classList.remove('d-flex');
            });
            this._itemNumber++;
        });

        document.getElementsByName('answer_discret_amount')[0].addEventListener('change', event => {
            
            if (document.getElementById('discret_options').getAttribute('used') == 'false') {
                document.getElementById('discret_options').childNodes.forEach(element => {
                    if ((element as HTMLDivElement).classList.contains('d-flex')) {
                        
                        (element as HTMLDivElement).classList.add('d-none');
                        (element as HTMLDivElement).classList.remove('d-flex');
                    }
                });
                document.getElementById('discret_options').classList.remove('d-none');
                document.getElementById('discret_options').classList.add('d-flex');
                document.getElementById('discret_options').classList.add('flex-row');
                document.getElementById('discret_options').classList.add('align-items-center');
                document.getElementById('discret_options').classList.add('justify-content-center');
                
                let amount = parseInt((document.getElementsByName('answer_discret_amount')[0] as HTMLInputElement).value);

                for (let i=0; i < amount; ++i) {
                    let discret_options_row   = document.createElement('DIV');
                    let fileInput               = document.createElement('INPUT');
                    let inputLabel              = document.createElement('LABEL');
                    let labelContent            = document.createElement('I');
                    
                    let bootstrapClass;
                    switch (amount) {
                        case 3:
                            bootstrapClass = '4';
                            break;
                        case 4:
                            bootstrapClass = '3';
                            break;
                        case 5:
                            bootstrapClass = '2';
                            break;
                        case 6:
                            bootstrapClass = '2';
                            break;
                        case 7:
                            bootstrapClass = '1';
                            break;
                        case 8:
                            bootstrapClass = '1';
                            break;
                        case 9:
                            bootstrapClass = '1';
                            break;
                    }

                    discret_options_row.classList.add('col-12', 'col-sm-12', 'col-md-' + bootstrapClass, 'col-lg-'  + bootstrapClass, 'col-xl-'  + bootstrapClass, 'd-flex');
                    fileInput.setAttribute('type', 'file');
                    fileInput.setAttribute('name', 'item_image[]');
                    fileInput.setAttribute('item-number', this._itemNumber + "");
                    fileInput.setAttribute('alt', 'Campo para inserir a imagem da opção.');
                    fileInput.setAttribute('title', 'Selecione uma imagem.');
                    fileInput.setAttribute('id', 'image_option');
                    inputLabel.classList.add('add-image-button');
                    inputLabel.setAttribute('for','image_option');
                    labelContent.classList.add('material-icons');
                    labelContent.textContent = "add_a_photo";
                    inputLabel.appendChild(labelContent);
                    inputLabel.innerHTML += "adicionar imagem";

                    discret_options_row.appendChild(inputLabel);
                    discret_options_row.appendChild(fileInput);

                    fileInput.addEventListener('change', event => {
                        document.getElementById('discret_options').setAttribute('used', 'true');
                    })

                    document.getElementById('discret_options').appendChild(discret_options_row);
                }
            } else {
                alert('voce precisa antes terminar de preencher');
            }

        });

        this._fields['answer_type'].addEventListener('change', event => {
            
            if (this._fields['answer_type'].value == '_DISCRET_') {
                
                document.getElementById('options_amount').classList.remove('d-none');
                document.getElementById('options_amount').classList.add('d-flex');
                document.getElementById('continuos_options').classList.add('d-none');
                document.getElementById('continuos_options').classList.remove('d-flex');
            
            } else if (this._fields['answer_type'].value == '_CONTINUOS_') {
                
                document.getElementById('options_amount').classList.add('d-none');
                document.getElementById('options_amount').classList.remove('d-flex');
                document.getElementById('continuos_options').classList.remove('d-none');
                document.getElementById('continuos_options').classList.add('d-flex');
                document.getElementById('continuos_options').classList.add('flex-row');
                document.getElementById('continuos_options').classList.add('align-items-center');
                document.getElementById('continuos_options').classList.add('justify-content-center');
                

                for (let i=0; i<3; ++i) {
                    let continuos_options_row   = document.createElement('DIV');
                    let fileInput               = document.createElement('INPUT');
                    let inputLabel              = document.createElement('LABEL');
                    let labelContent            = document.createElement('I');
                    
                    continuos_options_row.classList.add('col-12', 'col-sm-12', 'col-md-4', 'col-lg-4', 'col-xl-4', 'd-flex');
                    fileInput.setAttribute('type', 'file');
                    fileInput.setAttribute('name', 'item_image[]');
                    fileInput.setAttribute('item-number', this._itemNumber + "");
                    fileInput.setAttribute('alt', 'Campo para inserir a imagem da opção.');
                    fileInput.setAttribute('title', 'Selecione uma imagem.');
                    fileInput.setAttribute('id', 'image_option');
                    inputLabel.classList.add('add-image-button');
                    inputLabel.setAttribute('for','image_option');
                    labelContent.classList.add('material-icons');
                    labelContent.textContent = "add_a_photo";
                    inputLabel.appendChild(labelContent);
                    inputLabel.innerHTML += "adicionar imagem";

                    continuos_options_row.appendChild(inputLabel);
                    continuos_options_row.appendChild(fileInput);



                    document.getElementById('continuos_options').appendChild(continuos_options_row);
                }


            } else {
            
                document.getElementById('add-image-row').classList.add('d-none');
                document.getElementById('add-image-button-container').classList.add('d-none');
            
            }

        });

        // this._fields['answer_image'].addEventListener('change', event => {
        //     let files = this._fields['answer_image'].files;
        //     let containerDiv;
        //     let inputOptionValue;
        //     let hiddenInputOptionValue;
        //     let hiddenInputFile;
        //     let img;

        //     if (this._verifyImageLimit(files)) {
        //         let count = 0;
        //         let clone = this._fields['answer_image'].cloneNode(true);
        //         clone.setAttribute('item',this._itemNumber);
        //         clone.setAttribute('id',"");
        //         clone.setAttribute('name', 'item_answerImages'+this._itemNumber);
        //         this._sharedFields.push(clone);
                
        //         Array.from(files).forEach(element => {

        //             img = document.createElement("IMG");
                    
        //             //itemFileInput.setAttribute('optionValue', )
        //             hiddenInputFile = document.createElement('INPUT');
        //             hiddenInputOptionValue = document.createElement('INPUT');
        //             hiddenInputFile.setAttribute('type', 'hidden');
        //             hiddenInputFile.setAttribute('value', this._fields['answer_image'].files[count]);
        //             hiddenInputOptionValue.setAttribute('type','hidden');
        //             hiddenInputOptionValue.setAttribute('name','option-' + count + '-path');
        //             img.classList.add("mt-3");
        //             img.setAttribute('src', URL.createObjectURL(this._fields['answer_image'].files[count]));
        //             img.setAttribute('uploadValue', this._fields['answer_image'].files[count]);
        //             containerDiv = document.createElement("DIV");
        //             containerDiv.classList.add("col-12", "col-sm-6", "col-md-3", "col-lg-3", "col-xl-3", "item-image-container", "d-flex", "flex-column", "justify-content-center");
        //             inputOptionValue = document.createElement('INPUT');
        //             inputOptionValue.setAttribute('placeholder','Valor da opção');
        //             inputOptionValue.setAttribute('width','90%');
        //             inputOptionValue.setAttribute('name','option-value-' + count);
        //             inputOptionValue.classList.add('mt-1');
        //             containerDiv.appendChild(hiddenInputFile);
        //             containerDiv.appendChild(img);
        //             containerDiv.appendChild(hiddenInputOptionValue);
                    
                    
        //             document.getElementById('add-image-row').appendChild(containerDiv);
        //             count++;
                
        //         });

        //     } else {
                
        //         alert("implementar aqui");
            
        //     }
    
        // });

        // this._fields['answer_image'].addEventListener('click', event => {
            
        //     this._fields['answer_image'].value = "";
    
        // });
    }

    private _getModalItems() {

        let row = document.createElement('TR');
        let cell1 = document.createElement('TD');
        let cell2 = document.createElement('TD');
        let cell3 = document.createElement('TD');
        let p;

        let itemEnunciationInput = document.createElement('INPUT');
        let itemTypeInput = document.createElement('INPUT');
        // let itemImageInput = document.createElement('INPUT');
        //let itemImageInput = document.getElementsByName('item_answerImages');

        // itemImageInput.setAttribute('type','hidden');
        // itemImageInput.setAttribute('name','item_answerImages[]');
        // document.getElementById('add-image-row').childNodes.forEach(node => {
        //     let itemFileInput = document.createElement('INPUT');
        //     itemFileInput.setAttribute('type','file');
        //     itemFileInput.setAttribute('name','item_answerImages[]');
        //     itemFileInput.classList.add('d-none');
            
            
            
        //     row.appendChild(itemFileInput);
        // });
        itemEnunciationInput.setAttribute('type', 'hidden');
        itemEnunciationInput.setAttribute('name', 'item_answerEnunciation[]');
        itemTypeInput.setAttribute('type', 'hidden');
        itemTypeInput.setAttribute('name', 'item_answerType[]');

        row.setAttribute('name','item_row');
        
        //(itemImageInput as HTMLInputElement).value          = this._getModalImageOptions();
        (itemEnunciationInput as HTMLInputElement).value    = this._fields['enunciation'].value;
        (itemTypeInput as HTMLInputElement).value           = this._fields['answer_type'].value;
        

        row.addEventListener('click', event => {
            alert("Em implementação.");
        });

        p = document.createElement('P');
        p.classList.add('white-color');

        cell1.classList.add('white-color');
        cell1.textContent = (itemEnunciationInput as HTMLInputElement).value;

        p.textContent = (itemTypeInput as HTMLInputElement).value;
        
        cell2.classList.add('white-color');
        cell2.textContent = (itemTypeInput as HTMLInputElement).value;

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

        cell3.classList.add('d-flex','justify-content-end','align-items-center');

        cell3.appendChild(actionIcon1);
        cell3.appendChild(actionIcon2);
        cell3.appendChild(actionIcon3);

        row.appendChild(itemEnunciationInput);
        row.appendChild(itemTypeInput);
        //row.appendChild(itemImageInput);
        row.appendChild(cell1);
        row.appendChild(cell2);
        row.appendChild(cell3);
        
        this._sharedFields.forEach(element => {
            document.getElementById('data-row').appendChild(element);
        })

        this._clearItemModal();
        this._itemNumber++;
        return row;
    }

    private _clearItemModal() {
        document.getElementById('add-image-row').innerHTML = "";
        this._fields['enunciation'].value = "";
        this._fields['answer_type'].value = "";
    }

    private _getModalImageOptions() {
        
        let finalStr = "";

        document.getElementById('add-image-row').childNodes.forEach(element => {

            finalStr += (element.childNodes[0] as HTMLImageElement).src + '&' + (element.childNodes[2] as HTMLInputElement).value + '@';

        });

        return finalStr.replace(/.$/,"");

    }

    private _verifyImageLimit(filesArray): Boolean {
        
        if (this._fields['answer_type'].value == '_DISCRET_') {
            //from 5 to 9
            return ((document.getElementById('add-image-row').childNodes.length + filesArray.length) < 10);

        } else if (this._fields['answer_type'].value == '_CONTINUOS_') {
            //just 3 elements
            return ((document.getElementById('add-image-row').childNodes.length + filesArray.length) < 4);
        }
    
    }
}