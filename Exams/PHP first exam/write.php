<?php
/**
 * Created by PhpStorm.
 * User: mikayel
 * Date: 6/13/16
 * Time: 10:52 PM
 */

    $file = fopen($fileName, 'w') or die("I'm sorry dude");
    for($i=0;$i<count($array);$i++){
        $line = implode('|', $array[$i]);
        if($add && $i == count($array) - 2){
            $line .= PHP_EOL;
        }
        fputs($file, $line);
    }
    fclose($file);