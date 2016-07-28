<?php

/**
 * Created by PhpStorm.
 * User: mikayel
 * Date: 7/23/16
 * Time: 10:04 AM
 */
class Connect
{

    const HOST = "localhost";
    const USER_NAME = "root";
    const PASSWORD = "Myfeelfree";
    const DATABASE = "daily";

    /**
     * @var PDO
     */
    private static $connection;


    /**
     * Protected constructor to prevent creating a new instance of the
     * *Singleton* via the `new` operator from outside of this class.
     */
    private function __construct()
    {
    }

    /**
     * Private clone method to prevent cloning of the instance of the
     * *Singleton* instance.
     *
     * @return void
     */
    private function __clone()
    {
    }

    /**
     * @return PDO
     */
    public static function getConnection()
    {
        if (self::$connection === NULL){
            $conn = new PDO("mysql:host=" . self::HOST . ";dbname=" .  self::DATABASE, self::USER_NAME , self::PASSWORD);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            self::$connection = $conn;
        }
        return self::$connection;
    }




}