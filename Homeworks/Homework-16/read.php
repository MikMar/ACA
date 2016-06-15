<?php
/**
 * Created by PhpStorm.
 * User: mikayel
 * Date: 6/13/16
 * Time: 10:51 PM
 */
    $array = [];
    $file = fopen('Array.txt', 'r') or  die('die massage');
    while(!feof($file)){ //while it's not file end
        $line = fgets($file);   //getting line
        $wordCount = explode(' ', $line); //getting massive with words in that line
        $tempArrayLine = [];
        $tempArrayLine['name'] = $wordCount[0];
        $tempArrayLine['surname'] = $wordCount[1];
        $tempArrayLine['country'] = $wordCount[2];
        $tempArrayLine['city'] = $wordCount[3];
        //creating line for new array
        $array[] = $tempArrayLine;
        //pushing to final array
    }
    fclose($file);