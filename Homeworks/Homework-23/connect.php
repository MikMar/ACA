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
define('DB_NAME', 'aca');

// Create connection
$conn = new mysqli(SERVER_NAME, USER_NAME, PASSWORD, DB_NAME);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}