<?php

require_once 'classes/Connection.php';
require_once 'classes/SQLTools.php';

ini_set('memory_limit', '-1');
$csvArray = [];

$file = fopen('GeoIPCountryWhois.csv', 'r');
while (($csv = fgetcsv($file, ',')) !== FALSE ) {
    $csvArray[] = $csv;
}

$sqlTools = new SQLTools(Connection::getConnection());
$sqlTools->writeGeo($csvArray);
