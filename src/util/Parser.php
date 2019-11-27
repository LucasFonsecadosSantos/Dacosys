<?php

namespace Util;

class Parser
{
    public static function getID($data) 
    {
        return strtok($data,'@');
    }

    public static function shiftID($id, $data)
    {
        return str_replace($id."@", "", $data);
    }

    // public static function getIdItemsArrayString($data)
    // {
    //     $str = "";
    //     if (gettype($data) == 'string') {
    //         echo preg_replace("/^@/",'',Parser::getFirstID($data));;
    //     }

    //     if (($data == null) || (count($data) == 0)) {
    //         return $str;
    //     } else {
    //         foreach ($data as $item) {
    //             $str .= '@' . $item->id_item;
    //         }
    //         return preg_replace("/^@/",'',$str);
    //     }
    // }

    // public static function getFirstID($data)
    // {
    //     $id = explode('@', $data)[0];
    //     return $id;
    // }

    // public static function removeFirstIndex($data)
    // {
    //     return strstr($data, "@");
    // }
}