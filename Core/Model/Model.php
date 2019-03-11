<?php

namespace Core\Model;

use PDO;
use App\Config;

abstract class Model
{
    static function getPdoConnection()
    {
        static $pdoConn = null;

            $host = Config::HOST;
            $userName = Config::USERNAME;
            $dbName = Config::DBNAME;
            $password = Config::PASSWORD;

        if ($pdoConn === null) {
            $dsn = "mysql:host={$host};dbname={$dbName}";

            try {
                $pdoConn = new PDO($dsn, $userName, $password);
                $pdoConn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
                $pdoConn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                
                return $pdoConn;
            } catch (PDOException $e) {
                echo $e->getMessage();
            }
        }

        return $pdoConn;
    }
}
