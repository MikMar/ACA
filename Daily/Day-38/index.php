<?php
/**
 * Created by PhpStorm.
 * User: mikayel
 * Date: 8/10/16
 * Time: 7:33 PM
 */

$ch = curl_init();
curl_setopt_array(
    $ch, array(
    CURLOPT_URL => 'https://qrng.anu.edu.au/API/jsonI.php?length=10&type=uint8',
    CURLOPT_RETURNTRANSFER => true
));

$output = curl_exec($ch);
$output = json_decode($output);
var_dump($output->data);