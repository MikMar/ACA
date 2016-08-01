<?php
/**
 * Created by PhpStorm.
 * User: mikayel
 * Date: 7/2/16
 * Time: 7:20 PM
 */

class SQLTools
{
    /**
     * @var string
     */
    private $errorMessage;

    /**
     * @var PDO
     */
    private $db;

    /**
     * @return string
     */
    public function getErrorMessage()
    {
        return $this->errorMessage;
    }

    /**
     * Tools constructor.
     */
    public function __construct($db)
    {
        $this->errorMessage = '';
        $this->db = $db;
    }

    /**
     *@param string $sql SQL query
     *@return array
     */
    public function fetchAssoc($sql)
    {
        try
        {
            $statement = $this->db->prepare($sql);
            $statement->execute();
            // $statement->setFetchMode(PDO::FETCH_ASSOC); default fetch mode was chosen FETCH_ASSOC in dependencies.php
            $result = $statement->fetchAll();
            return $result;
        }
        catch (PDOException $e)
        {
            $this->errorMessage = $e->getMessage();
        }
    }

    public function getAll($table)
    {
        return $this->fetchAssoc("SELECT * FROM " . $table);
    }

    /**
     * @param string $country Name
     * @return array
     */
    public function getUsersFromCountry($country){
        $sql = "
        SELECT 
            `full_name`
        FROM `user`
        WHERE `country` = " . "'" . $country . "'";
        return $this->fetchAssoc($sql);
    }
}

