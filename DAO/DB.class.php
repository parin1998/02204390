<?php
class DB
{
    private static $instance = NULL;
    private static $dsn = "mysql:dbname=shop;host=localhost;charset=utf8";
    private static $user = "root";
    private static $pass = "";
    private function __construct() {}
    private function __clone() {}
    public static function getInstance() {
        if (!isset(self::$instance)) {
            self::$instance = new PDO(self::$dsn,self::$user,self::$pass);
        }
        return self::$instance;
    }
}