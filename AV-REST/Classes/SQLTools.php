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

    public function getJuice($brand)
    {
        if (isset($brand)) {
            return $this->fetchAssoc('
                SELECT * from `av_juice`
                WHERE `brand` =  "' . $brand . '"'
            );
        } else {
            return $this->fetchAssoc("
            SELECT * FROM `av_juice`"
            );
        }
    }

    public function getBrands()
    {
        return $this->fetchAssoc("
            SELECT DISTINCT `brand` FROM `av_juice`
        ");
    }
}

