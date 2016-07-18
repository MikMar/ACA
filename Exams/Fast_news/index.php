<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Fast News</title>

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

<?php
require_once 'tools.php';
include_once 'header.php';

define ('ITEMS_PER_PAGE', 2);

if(isset($_GET['category'])){
    $categoryId = $_GET['category'];
    if(isset($_GET['page'])){
        $page = $_GET['page'];
    } else {
        $page = 0;
    }
    $array = getNewsByCategory($categoryId, $page * ITEMS_PER_PAGE, ITEMS_PER_PAGE); // FROM, LIMIT, OFFSET

    $sql = 'SELECT count(*) AS count FROM `news` WHERE category_id = ' . $categoryId;
    $pageCount = ceil($conn->query($sql)->fetch_assoc()['count']/ITEMS_PER_PAGE); // post count / Items per page and ceil to upper value
} else{
    if (isset($_GET['search'])){ // to print corresponding posts after search
        $array = [];
        $array = search($_GET['search']);
        $pageCount = count($array);
        if (count($array) == 0){
            echo '<h1 class="text-center">No result for "' . $_GET['search'] . '"</h1>';
            die;
        }
    } else {
        echo '<h1 class="text-center">Welcome to Fast News!</h1>';
        die;

    }
}
?>

<body>
    <div class="container margin-top">
        <div class="row">
            <div class="col-xs-12">
                <?php
                foreach ($array as $key => $value){
                    echo
                        '<div class="panel panel-primary">
                            <div class="panel-heading">
                                <h3 class="panel-title">' . $value['title'] . '</h3>
                            </div>
                            <div class="panel-body">' . $value['content'] . '</div>
                        </div>';
                }
                ?>
            </div>

        </div>
        <?php
        if(!isset($_GET['search'])){ // no need for pagination in search
            include 'pagination.php';
        }
        ?>
    </div>


<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
    <script src="JS/script.js"></script>
</body>
</html>
