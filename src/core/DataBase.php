<?php

namespace Core;

use Util\Logger;
use PDO;
use PDOException;

class DataBase
{
    public function getInstance()
    {
        Logger::log_message(Logger::LOG_INFORMATION, "Getting database driver informations...");
        $settings = include_once __DIR__ . "/../app/database_driver.php";

        if ($settings["driver"] == "sqlite") {
            $driver = __DIR__ . "/../storage/database/" . $settings["sqlite"]["host"];
            $driver = "sqlite:" . $driver;
            Logger::log_message(Logger::LOG_INFORMATION, "DATABASE DRIVER FOUND: sqlite");
            Logger::log_message(Logger::LOG_INFORMATION, "DATABASE PATH FOUND: " . $driver);
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

            Logger::log_message(Logger::LOG_INFORMATION, "DATABASE DRIVER FOUND: mysql");
            Logger::log_message(Logger::LOG_INFORMATION, "DATABASE HOST FOUND: $host");
            Logger::log_message(Logger::LOG_INFORMATION, "DATABASE DATABASE FOUND: $database");
            Logger::log_message(Logger::LOG_INFORMATION, "DATABASE USER FOUND: $user");
            Logger::log_message(Logger::LOG_INFORMATION, "DATABASE PASSWORD FOUND: $password");
            Logger::log_message(Logger::LOG_INFORMATION, "DATABASE CHARSET FOUND: $charset");
            Logger::log_message(Logger::LOG_INFORMATION, "DATABASE COLLATION FOUND: $collation");

            try {
                $pdo = new PDO("mysql:host=$host;dbname=$database;charset=$charset",$user,$password);
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $pdo->setAttribute(PDO::MYSQL_ATTR_INIT_COMMAND, "SET NAMES  '$charset' COLLATE '$collation'" );
                $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
                Logger::log_message(Logger::LOG_SUCCESS, "Database instantiated.");
                return $pdo;
            } catch(PDOException $ex) {
                Logger::log_message(Logger::LOG_ERROR, "Database not instantiated.");
                echo $ex->getMessage();
            }
        }
    }
}