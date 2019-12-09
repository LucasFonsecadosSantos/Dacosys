<?php

namespace Util;

class Uploader 
{
    public static function makeUpload($fieldName)
    {
        $finalName = "";
        $amount = count($_FILES[$fieldName]['name']);
        
        $extension = strtolower(substr($_FILES[$fieldName]['name'], -4));
        $newName = md5(date("Y.m.d-H.i.s") . $_FILES[$fieldName]['tmp_name']) . $extension;
        // print_r($newName);
        // echo '<br/>';
        $dir = 'data/upload/item/imagens/';
        move_uploaded_file($_FILES[$fieldName]['tmp_name'], $dir . $newName);
           
        return $newName;
    }
}