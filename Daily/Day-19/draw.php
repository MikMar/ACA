<?php
/**
 * Created by PhpStorm.
 * User: mikayel
 * Date: 6/22/16
 * Time: 9:08 AM
 */

    foreach ($array as $key => $value){
        $tempTime = filectime(ROOT . $path . '/' . $value);
        if (is_dir(ROOT . $path . '/' . $value)){
            echo '<a href="?path=' . $path . '/' . $value . '"><span class="glyphicon glyphicon-folder-open yellow"></span>' . $value . '</a> ' . date('F d Y H:i:s' ,$tempTime) .'</br>';
            continue;
        }
        if (strpos($value, 'jpg') || strpos($value, 'png') || strpos($value, 'gif')){
            echo '<a href="' . $path . '/' . $key . '"><span class="glyphicon glyphicon-picture blue"></span>' . $value . '</a> ' . date('F d Y H:i:s' ,$tempTime) . '</br>';
            continue;
        }
            echo '<span class="glyphicon glyphicon-file red"></span>' . $value .  ' ' . date('F d Y H:i:s' ,$tempTime) .'</br>';

    }