<?php
/**
 * Created by PhpStorm.
 * User: mikayel.margaryan
 * Date: 6/15/2016
 * Time: 1:45 PM
 */
if(isset($_GET['id'])){
    $rowID = $_GET['id'];
    if( isset($_GET['name']) && isset($_GET['surname']) && isset($_GET['country']) && isset($_GET['city']) ){
        $tempLine = [];
        include 'read.php';
        $temp = $array;
        $tempLine['name'] = $_GET['name'];
        $tempLine['surname'] = $_GET['surname'];
        $tempLine['country'] = $_GET['country'];
        $tempLine['city'] = $_GET['city'] . PHP_EOL; // adding EOL to make fwrite() write 9 symbols (with eol)
        array_splice($temp, 0, ++$rowID);
        var_dump($temp);
        $array[$rowID] = $tempLine;
        array_splice($array, $rowID + 1, count($array), $temp);
        include 'write.php';
    }
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
            <h1 class="page-header">Edit row</h1>
            <form action="">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="name" aria-describedby="basic-addon1" name="name">
                    <input type="text" class="form-control" placeholder="surname" aria-describedby="basic-addon1" name="surname">
                    <input type="text" class="form-control" placeholder="country" aria-describedby="basic-addon1" name="country">
                    <input type="text" class="form-control" placeholder="city" aria-describedby="basic-addon1" name="city">
                    <input name="id" type="hidden" value=<?php echo $rowID; ?>>
                    <button class="btn-lg" type="submit">Submit</button>
                </div>
            </form>
            <br>
            <br>
            <a href="index.php">back</a>
        </div>

    </div>
</div>


<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
<script src="JS/script.js"></script>
</body>
</html>
