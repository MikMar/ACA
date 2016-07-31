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

$book = new Book();

$book->author = 'Raffi';
$book->title = 'Samuel';
$book->year = 1886;

echo $book->getJSON();