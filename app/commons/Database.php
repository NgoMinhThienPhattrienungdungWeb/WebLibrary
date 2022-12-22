<?php

include_once 'define.php';

class Database
{
    public static function getConnection()
    {
        static $connect = null;
        if (!$connect) {
            try {
                $connect = new PDO(DB_DNS, DB_USER, DB_PASSWORD);
                $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                echo $e->getMessage();
                exit();
            }
        }
        return $connect;
    }
}
