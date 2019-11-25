<?php

namespace Core;

class Auth
{
    private $id = null;
    private $name = null;
    private $email = null;

    public function __construct()
    {
        $this->id = Session::get('user')['id_person'];
        $this->name = Session::get('user')['name'];
        $this->email = Session::get('user')['email'];
    }

    public static function id()
    {
        return self::id;
    }

    public static function name()
    {
        return self::name;
    }

    public static function email()
    {
        return self::email;
    }

    public static function check()
    {
        return ((self::id == null) || (self::name == null) || (self::email == null)) ? false : true;
    }
}