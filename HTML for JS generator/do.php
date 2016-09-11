<?php
/**
 * Created by PhpStorm.
 * User: mikayel
 * Date: 9/5/16
 * Time: 8:27 PM
 */
$file = fopen('htmlnew.txt', 'w') or die;
$read = file('html.txt');
foreach ($read as $line) {
    $line = str_replace(PHP_EOL, '', $line);
    $line = "+'" . $line . "' +" . PHP_EOL;
    fwrite($file, $line);
}




