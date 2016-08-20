<?php

require_once 'Connection.php';
require_once 'Entity/NewContact.php';

class ContactTable
{
    /**
     * @var string
     */
    private $dbTable;

    public function __construct()
    {
        $this->dbTable = 'contacts';
    }

    public function createContact(NewContact $newContact)
    {
        $statement = Connection::getConnection()->prepare(
            "
                INSERT INTO `" . $this->dbTable . "`
                (
                  `job_id`,
                  `first_name`,
                  `last_name`,
                  `phone`
                )
                VALUES
                (
                  '" . $newContact->getJobId() . "',
                  '" . $newContact->getFirstName() . "',
                  '" . $newContact->getLastName() . "',
                  '" . $newContact->getPhone() . "'
                )
            "
        );

        $statement->execute();
    }
}