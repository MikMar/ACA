<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Bootstrap 101 Template</title>

    <!-- Bootstrap -->
    <!-- build
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    -->
    <link href="assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="CSS/style.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>

<div class="container">
    <div class="row">
        <div class="col-xs-12">
            <h1 class="page-header">Search results</h1>
            <?php
                include_once 'path.php';

                $name = $_GET['name'];
                $array = scanALL($path);

                function scanAll($string, $mainArray = []){
                    global $name;
                    $tempArray = scandir(ROOT . $string);
                    foreach ($tempArray as $key => $value){
                        if ($value == '.' || $value == '..'){
                            continue;
                        }
                        
                        if (strpos($value, $name) !== false){
                            $mainArray[$string . '/' . $value] = $value;
                        }

                        if (is_dir(ROOT . $string . '/' . $value)){
                            $mainArray = array_merge(scanAll($string . '/' . $value), $mainArray);
                        }
                    }
                    return $mainArray;
                }
            
                foreach ($array as $key => $value){
                    $tempTime = filectime(ROOT . $key);
                    if (is_dir(ROOT . $key)){
                        echo '<a href="http://localhost/Daily/Day-19/index.php?path=' . $key . '"><span class="glyphicon glyphicon-folder-open yellow"></span>' . $value . '</a> ' . date('F d Y H:i:s' ,$tempTime) .'</br>';
                        continue;
                    }
                    if (strpos($value, 'jpg') || strpos($value, 'png') || strpos($value, 'gif')){
                        echo '<a href="' . $key . '"><span class="glyphicon glyphicon-picture blue"></span>' . $value . '</a> ' . date('F d Y H:i:s' ,$tempTime) . '</br>';
                        continue;
                    }
                    echo '<span class="glyphicon glyphicon-file red"></span>' . $value .  ' ' . date('F d Y H:i:s' ,$tempTime) .'</br>';

                }
            ?>
        </div>
    </div>
</div>


<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<!-- build
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
-->
<script src="assets/bootstrap/js/bootstrap.min.js"></script>
<script src="JS/script.js"></script>
</body>
</html>







<?php


