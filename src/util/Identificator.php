<?php

namespace Util;

class Identificator
{
    public static function generateID($prefix = null)
    {
        return ($prefix != null) ? uniqid($prefix) : uniqid();
    }
}