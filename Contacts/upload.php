<?php

define('UPLOAD_ROOT', '/home/mikayel/Desktop/ACA/Contacts/uploads/');

if(isset($_FILES['fileToUpload'])) {

    require_once 'classes/JobTable.php';

    $uploadFile = $_FILES['fileToUpload'];
    if($uploadFile['error'] != 0){
        echo '<p>error occurred</p>';
    }

    // ensure a safe filename
    $name = preg_replace('/[^A-Z0-9._-]/i', '_', $uploadFile["name"]);

    $i = 0;
    // if file with that name already exists we will need parts to create unique name
    $parts = pathinfo(UPLOAD_ROOT . $name);
    while(file_exists(UPLOAD_ROOT  . $name)){
        $name = $parts['filename'] . '_' . ($i++) . '.' . $parts['extension'];
    }

    $uploadOk = 1;
// Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($uploadFile["tmp_name"], UPLOAD_ROOT . $name)) {
            echo "The file " . basename($name . " has been uploaded.");
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }

    chmod(UPLOAD_ROOT . $name, 0666);

    $lines = count(file(UPLOAD_ROOT  . $name));

    $jobTable = new JobTable();
    $jobTable->createJob($name, $lines);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Bootstrap 101 Template</title>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
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
            <h1 class="page-header">Writing to db</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12" id="_progress"></div>
    </div>
</div>


<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->

<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
<script src="JS/script.js"></script>
</body>
</html>


