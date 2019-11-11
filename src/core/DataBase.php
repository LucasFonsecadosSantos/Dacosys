<?php

namespace Core;

use PDO;
use PDOException;

class DataBase
{
    public function getInstance()
    {
        $settings = include_once __DIR__ . "/../app/database_driver.php";

        if ($settings["driver"] == "sqlite") {
            $driver = __DIR__ . "/../storage/database/" . $settings["sqlite"]["host"];
            $driver = "sqlite:" . $driver;
            try {
                $pdo = new PDO($driver);
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
                return $pdo;
            } catch(PDOException $ex) {
                echo $ex->getMessage();
            }
        } else if ($settings["driver"] == "mysql") {
            $host       = $settings["mysql"]["host"];
            $database   = $settings["mysql"]["database"];
            $user       = $settings["mysql"]["user"];
            $password   = $settings["mysql"]["pass"];
            $charset    = $settings["mysql"]["charset"];
            $collation  = $settings["mysql"]["collation"];

            try {
                $pdo = new PDO("mysql:host=$host;dbname=$database;charset=$charset",$user,$password);
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $pdo->setAttribute(PDO::MYSQL_ATTR_INIT_COMMAND, "SET NAMES  '$charset' COLLATE '$collation'" );
                $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
                return $pdo;
            } catch(PDOException $ex) {
                echo $ex->getMessage();
            }
        }
    }
}