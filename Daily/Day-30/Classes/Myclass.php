<?php

/**
 * Created by PhpStorm.
 * User: mikayel
 * Date: 7/23/16
 * Time: 10:04 AM
 */
class Myclass
{

    const HOST = "localhost";
    const USER_NAME = "root";
    const PASSWORD = "Myfeelfree";
    const DATABASE = "daily";

    /**
     * @var PDO
     */
    private static $connection = NULL;

    /**
     * Connection constructor.
     */
    private function __construct()
    {
    }

    private function __clone()
    {

    }
    /**
     * @return PDO
     */
    public function getConnection()
    {
        if (self::$connection == NULL){
            $conn = new PDO("mysql:host=" . self::HOST . ";dbname=" .  self::DATABASE, self::USER_NAME , self::PASSWORD);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            self::$connection = $conn;
        }
        return self::$connection;
    }
}