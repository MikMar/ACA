<?php
/**
 * Created by PhpStorm.
 * User: mikayel
 * Date: 7/25/16
 * Time: 8:34 PM
 */

define('ROOT', '/home/mikayel/Desktop/ACA/Daily/Day-30/MVC/');

$controller = 'home';
$action = 'index';

if (isset($_GET['controller']) && isset($_GET['action'])) {
    $controller = $_GET['controller'];
    $action = $_GET['action'];
}

$controller = ucfirst($controller);
$controller .= 'Controller';

if (file_exists( ROOT . 'Controller/' . $controller . '.php' )) {
    require_once ROOT . 'Controller/' . $controller . '.php';

    if (class_exists($controller)) {
        $controllerObj = new $controller;
        $action .= 'Action';
        if (method_exists($controllerObj, $action)) {

        } else {
            require_once ROOT . 'Controller/ErrorController.php';
            $errorController = new ErrorController($action . ' method not found', 404);
            $errorController->errorAction();
            die;
        }

    } else {
        require_once ROOT . 'Controller/ErrorController.php';
        $errorController = new ErrorController($controller . ' class not found', 404);
        $errorController->errorAction();
        die;
    }

} else {
    require_once ROOT . 'Controller/ErrorController.php';
    $errorController = new ErrorController($controller . ' file not found', 404);
    $errorController->errorAction();
    die;
}

$controllerObj->$action();