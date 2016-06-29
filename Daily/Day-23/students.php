<?php
/**
 * Created by PhpStorm.
 * User: mikayel
 * Date: 6/29/16
 * Time: 8:34 PM
 */
require_once 'database.php';

function getStudents(){
    global $conn;
    $sql = "SELECT id, first_name, last_name FROM student";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
            $students[] = $row;
        }
    }

    return $students;
}

function createStudent($student){
    global $conn;
    $sql = "INSERT INTO student (`first_name`, `last_name`) VALUE ('$student[0]', '$student[1]')";
    $conn->query($sql);

}

function deleteStudent($studentId){
    global $conn;
    $sql = "DELETE FROM student WHERE id='$studentId'";
    $conn->query($sql);

}

function updateStudent($student){
    global $conn;
    $sql = "UPDATE student SET first_name='" . $student['first_name'] ."', last_name='" . $student['last_name'] . "' WHERE id='" . $student['id'] . "'";
    $conn->query($sql);
}