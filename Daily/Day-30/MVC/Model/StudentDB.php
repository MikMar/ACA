<?php

/**
 * Created by PhpStorm.
 * User: mikayel
 * Date: 7/23/16
 * Time: 10:13 AM
 */


require_once ROOT . 'Model/Connection.php';
require_once ROOT . 'Model/Student.php';

class StudentDB
{
    /**
     * @var string
     */
    private $dbTable;

    private $dbConnection;

    /**
     * SudentDB constructor.
     * @param string $dbTable
     */
    public function __construct()
    {
        $this->dbTable = 'student';
        $this->dbConnection = new Connection();
    }

    public function getStudents()
    {
        $statement = $this->dbConnection->getConnection()->prepare('SELECT id, name, surname FROM student');
        $statement->execute();
        $statement->setFetchMode(PDO::FETCH_ASSOC);

        $result = $statement->fetchAll();

        $students = [];
        foreach ($result as $item){
            $student = new Student($item['id'], $item['name'], $item['surname']);
            $students[] = $student;
        }
        return $students;

    }

    public function deleteStudent($studentId)
    {
        $statement = $this->dbConnection->getConnection()->prepare('DELETE FROM ' . $this->dbTable . ' WHERE id=' . $studentId);
        $statement->execute();

    }

}