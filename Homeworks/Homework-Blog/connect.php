<?php
/**
 * Created by PhpStorm.
 * User: mikayel
 * Date: 6/29/16
 * Time: 8:29 PM
 */

define('SERVER_NAME', 'localhost');
define('USER_NAME', 'root');
define('PASSWORD', 'Myfeelfree');
define('DB_NAME', 'daily');

// Create connection
$conn = new mysqli(SERVER_NAME, USER_NAME, PASSWORD, DB_NAME);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$conn->query("SET NAMES 'utf8'");
$conn->query("SET CHARACTER SET 'utf8'"); //to make sure that you using UTF8