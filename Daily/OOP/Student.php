<?php

/**
 * Created by PhpStorm.
 * User: mikayel
 * Date: 7/20/16
 * Time: 7:40 PM
 */
class Student
{
    /**
     * @var string
     */
    private $firstName;
    /**
     * @var string;
     */
    private $lastName;
    /**
     * @var int
     */
    private $age;

    /**
     * Student constructor.
     * @param string $firstName
     * @param string $lastName
     * @param int $age
     */
    public function __construct($firstName, $lastName, $age)
    {
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->age = $age;
    }

    public function setName($first, $last)
    {
        $this->firstName = $first;
        $this->lastName = $last;
    }

    public function sayHello()
    {
        echo 'Hello I am ' . $this->firstName . ' ' . $this->lastName;
    }

    /**
     * @return string
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * @param string $firstName
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;
    }

    /**
     * @return string
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * @param string $lastName
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;
    }

    /**
     * @return int
     */
    public function getAge()
    {
        return $this->age;
    }

    /**
     * @param int $age
     */
    public function setAge($age)
    {
        $this->age = $age;
    }
/*
    private function ()
    {
        $this->firstName = 'Mikayel';
        $this->lastName = 'Margaryan';
        $this->age = 24;
    }
*/

}