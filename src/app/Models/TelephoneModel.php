<?php

namespace App\Models;

use Core\Model;

class TelephoneModel extends Model 
{
    protected $table = "telephone";

    public function prepareToInsert(array $data)
    {
        // print_r($data)/
        if (($data['telephone'] != "") || $data['telephone']) {
            $data['telephone'] = explode('@', $data['telephone']);
            foreach ($data['telephone'] as $telephone) {
                $telephone = str_replace('(','',$telephone);
                $telephone = str_replace(')','',$telephone);
                $telephone = str_replace(' ','',$telephone);
                $telephone = str_replace('-','',$telephone);
            }
        }
        return $data;
    }
}