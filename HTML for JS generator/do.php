<?php
/**
 * Created by PhpStorm.
 * User: mikayel
 * Date: 9/5/16
 * Time: 8:27 PM
 */
$file = fopen('htmlnew.txt', 'w') or die;
$file2 = fopen('html.txt', 'r') or die;
while (($line = fgets($file2)) !== false) {
    $line = "'" . rtrim($line) . "' + " . PHP_EOL;
    fwrite($file, $line);
}




