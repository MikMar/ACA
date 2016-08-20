<?php

require_once 'Connection.php';

class JobTable
{
    /**
     * @var string
     */
    private $dbTable;

    public function __construct()
    {
        $this->dbTable = 'job';
    }

    public function getJobs()
    {
        $statement = Connection::getConnection()->prepare(
            'SELECT `id`, `file_name`, `total`, `current`
            FROM job
            WHERE `status`=0'
        );
        $statement->execute();
        $statement->setFetchMode(PDO::FETCH_ASSOC);
        $result = $statement->fetchAll();
        return $result;
    }

    public function createJob($fileName, $total)
    {
        $statement = Connection::getConnection()->prepare(
            "INSERT INTO `job` (`file_name`, `total`) VALUES ('" . $fileName . "', '" . $total . "')");
        $statement->execute();
    }

    public function changeJobStatus($jobId, $jobStatus)
    {
        $statement = Connection::getConnection()->prepare(
            "
              UPDATE `job` SET `status` = " . $jobStatus . " WHERE `id` = " . $jobId . "
            "
        );
        $statement->execute();
    }

    public function changeJobCurrent($jobId, $current)
    {
        $statement = Connection::getConnection()->prepare(
            "
              UPDATE `job` SET `current` = " . $current . " WHERE `id` = " . $jobId . "
            "
        );
        $statement->execute();
    }
}