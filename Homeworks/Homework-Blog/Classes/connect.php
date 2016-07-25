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
    protected $connection;

    /**
     * Connection constructor.
     */
    public function __construct()
    {
        $conn = new PDO("mysql:host=" . self::HOST . ";dbname=" .  self::DATABASE, self::USER_NAME , self::PASSWORD);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $this->connection = $conn;
    }

    /**
     * @return PDO
     */
    public function getConnection()
    {
        return $this->connection;
    }




}