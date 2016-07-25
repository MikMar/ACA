<?php
/**
 * Created by PhpStorm.
 * User: mikayel
 * Date: 7/25/16
 * Time: 8:34 PM
 */

define('ROOT', '/home/mikayel/Desktop/ACA/Daily/Day-30/MVC/');

$controller = $_GET['controller'];
$action = $_GET['action'];

$controller = ucfirst($controller);
$controller .= 'Controller';

require_once ROOT . 'Controller/' . $controller . '.php';

$controllerObj = new $controller;

$action .= 'Action';

$controllerObj->$action();