<?php
/**
 * Created by PhpStorm.
 * User: mikayel
 * Date: 6/13/16
 * Time: 10:52 PM
 */

    $file = fopen('Array.txt', 'w') or die("I'm sorry dude");
    for($i=0;$i<count($array);$i++){
        $line = $array[$i]['name'] . ' ' .  $array[$i]['surname'] . ' ' . $array[$i]['country'] . ' ' . $array[$i]['city'];
        fwrite($file, $line);
    }
    fclose($file);