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
}