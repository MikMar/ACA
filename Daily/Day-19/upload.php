<?php
/**
 * Created by PhpStorm.
 * User: mikayel
 * Date: 6/22/16
 * Time: 7:34 PM
 */
    $path = $_POST['path'];
    if (!empty($_FILES['uploadFile'])){
        $uploadFile = $_FILES['uploadFile'];

        if($uploadFile['error'] != 0){
            echo '<p>error occurred</p>';
        }
    }

    $name = preg_replace('/[^A-Z0-9._-]/i', '_', $uploadFile["name"]);

    $i = 0;
    $parts = pathinfo($path . $name);
    while(file_exists($path . '/' . $name)){
        $name = $parts['filename'] . '_' . ($i++) . '.' . $parts['extension'] ;
    }

    $success = move_uploaded_file($uploadFile['tmp_name'], $path . '/' . $name);

    if (!$success){
        echo '<p>unable to safe file</p>';
        die;
    }

    chmod($path . '/'. $name, 0666);

    header('Location: ' . $path);
