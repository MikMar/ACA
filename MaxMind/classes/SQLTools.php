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

    public function writeGeo($array)
    {
        $sql = '
            INSERT INTO `geo` (`ip_start`, `ip_end`, `number_start`, `number_end`, `country_code`, `country`)
            VALUES (' .
            ' "' . $array[0] . '",' .
            ' "' . $array[1] . '",' .
            ' "' . $array[2] . '",' .
            ' "' . $array[3] . '",' .
            ' "' . $array[4] . '",' .
            ' "' . $array[5] . '"' .
        ')';
        $statement = $this->db->prepare($sql);
        $statement->execute();
    }

    public function getCountry($ip)
    {
        $sql = '
            SELECT `country` FROM `geo`
            WHERE `number_start` <= ' . $ip . ' AND `number_end` >= ' . $ip
        ;
        return $this->fetchAssoc($sql);
    }
}

