<?php
/**
 * Created by PhpStorm.
 * User: mikayel
 * Date: 7/31/16
 * Time: 11:12 AM
 */

spl_autoload_register(function($class_name) {
    require $class_name . ".php";
});

$jsonWriter = new JsonWriter();
$jsonWriter->setData(['Author' => 'Mikayel']);
echo $jsonWriter->getData();