<?php

namespace Core;

class Validator
{

    private const REQUIRED      = 'required';
    private const EMAIL         = 'email';
    private const TELEPHONE     = 'telephone';
    private const CELLPHONE     = 'cellphone';
    private const FLOAT_TYPE    = 'float_type';
    private const INT_TYPE      = 'int_type';
    private const ONLY_LETTERS  = 'only_letters';
    private const ONLY_NUMBERS  = 'only_numbers';

    public static function make(array $data, array $rules)
    {
        foreach ($rules as $ruleKey => $ruleValue) {
            foreach ($data as $dataKey => $dataValue) {
                if ($rulesKey == $dataKey) {
                    switch ($ruleValue) {
                        
                        case Validator::REQUIRED:
                            if ($dataValue == '' || empty($dataValue)) {
                                $errors["$rulesKey"] = "O campo {$ruleKey} deve ser preenchido.";
                            }
                        break;

                        case Validator::EMAIL:
                            if (!filter_var($dataValue, FILTER_VALIDATE_EMAIL)) {
                                $errors["$ruleKey"] = "O campo {$ruleKey} não é válido.";
                            }
                            break;
                    }
                }
            }
        }
    }
}