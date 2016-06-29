<?php
/**
 * Created by PhpStorm.
 * User: mikayel
 * Date: 6/13/16
 * Time: 10:51 PM
 */

    $array = [];
    $file = fopen($fileName, 'r') or  die('die massage');
    while(!feof($file)){ //while it's not file end
        $line = fgets($file);   //getting line
        $array[] = explode('|', $line); //getting massive with words in that line
        //pushing to final array
    }
    fclose($file);