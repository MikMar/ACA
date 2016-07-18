<?php
/**
 * Created by PhpStorm.
 * User: mikayel
 * Date: 7/5/16
 * Time: 1:24 PM
 */
define('PATH', 'img/'); //for lecturer profile pics
require_once 'tools.php';

if (isset($_GET['table']) && isset($_GET['col'])){
    $message = delete($_GET['table'], $_GET['col']);
    if ($message == ''){
        $message = 'Deleted successfully';
    }
    header('Location: http://localhost/Exams/Fast_news/panel.php?table=' . $_GET['table'] . '&message=' . $message);
}
