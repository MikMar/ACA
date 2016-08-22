<?php

require_once 'classes/JobTable.php';

$jobTable = new JobTable();
$jobs = $jobTable->getJobs();
$widthArray = [];

foreach ($jobs as $job) {
    $widthArray[$job['file_name']] = $job['current'] * 100 / $job['total'];
}

header('Content-Type:application/json');
echo json_encode($widthArray);
