<?php
/**
 * Created by PhpStorm.
 * User: mikayel
 * Date: 7/2/16
 * Time: 7:20 PM
 */

require_once 'connect.php';

function get($table){
    $temp = [];
    global $conn;
    global $errorMessage;
    $sql = "SELECT * FROM " . $table;
    $result = $conn->query($sql);
    $errorMessage = mysqli_error($conn);
    if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
            $temp[] = $row;
        }
    }
    return $temp;
}

function add($table, $tempArray){
    global $conn;
    global $errorMessage;
    $query = '';
    foreach ($tempArray as $key => $value){
        $query .= "'" . $value . "', ";
    }
    $query = substr($query, 0, -2);
    $sql = "INSERT INTO $table VALUE ($query)";
    $conn->query($sql);
    $errorMessage = mysqli_error($conn);

}

function delete($table, $col){
    global $conn;
    global $errorMessage;
    //processing image delete
    $sql = 'SELECT * FROM ' . $table . ' WHERE id=' .$col;
    $result = $conn->query($sql)->fetch_assoc();
    var_dump($result);
    foreach ($result as $key => $value){
        if (strpos($key, 'img') !== false){ //if it is field for image we should delete image before deleting row
            if (!unlink(PATH . '/' . $value)){ //deleting file with that name from img folder
                die;
            } 
        }
    }

    $sql = 'DELETE FROM ' . $table . ' WHERE id=' .$col;
    $conn->query($sql);
    $errorMessage = mysqli_error($conn);
    var_dump($errorMessage);
    return $errorMessage;
}