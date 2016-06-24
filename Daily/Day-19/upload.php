<?php
/**
 * Created by PhpStorm.
 * User: mikayel
 * Date: 6/22/16
 * Time: 7:34 PM
 */
    define('ROOT', '/home/mikayel/Desktop/ACA/');
    $path = '';
    if (isset($_POST['path'])){
        $path = $_POST['path'];
    }

    if (!empty($_FILES['uploadFile'])){
        $uploadFile = $_FILES['uploadFile'];

        if($uploadFile['error'] != 0){
            echo '<p>error occurred</p>';
        }
    }

    $name = preg_replace('/[^A-Z0-9._-]/i', '_', $uploadFile["name"]);

    $i = 0;
    $parts = pathinfo(ROOT . $path . '/' . $name);
    while(file_exists(ROOT . $path . '/' . $name)){
        $name = $parts['filename'] . '_' . ($i++) . '.' . $parts['extension'] ;
    }

    $success = move_uploaded_file($uploadFile['tmp_name'], ROOT . $path . '/' . $name);

    if (!$success){
        echo '<p>unable to safe file</p>';
        die;
    }

    chmod(ROOT . $path . '/'. $name, 0666);

    header('Location: http://localhost/Daily/Day-19/index.php?path=' . $path);
