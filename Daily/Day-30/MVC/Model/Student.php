<?php

/**
 * Created by PhpStorm.
 * User: mikayel
 * Date: 7/23/16
 * Time: 9:27 AM
 */

class Student
{
    /**
     * @var int
     */
    private $id = NULL;
    /**
     * @var string
     */
    private $firstName;
    /**
     * @var string
     */
    private  $lastName;

    /**
     * Student constructor.
     * @param int $id
     * @param string $firstName
     * @param string $lastName
     */
    public function __construct($id, $firstName, $lastName)
    {
        $this->id = $id;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
    }



    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
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
     * Student constructor.
     * @param string $course
     */
}