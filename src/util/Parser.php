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

    public static function getItemEnunciation($data)
    {
        return explode("@", substr($data, 0, -1));
    }

    public static function getItemType($data)
    {
        return explode("@", substr($data, 0, -1));
    }

    public static function getItemImage($data)
    {
        $images = explode("@", substr($data, 0, -1));
        
        for ($i = 0; $i < count($images); ++$i) {
            $images[$i] = strtok($images[$i], '&');
        }
        
        return $images;
    }


}