<?php
class Database
{
    private static $host = "localhost";
    private static $user = "root";
    private static $pwd = "root";
    private static $dbname = "data_structure";


    protected static function connect()
    {
        $db = new mysqli(self::$host, self::$user, self::$pwd, self::$dbname);
        if ($db->connect_error) {
            die("Connection failed: " . $db->connect_error);
        }

        return $db;
    }
}