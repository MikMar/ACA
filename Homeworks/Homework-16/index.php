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
<?php

    define('ITEMS_PER_PAGE', 4);
    include 'read.php'; //reading from file
    $size = count($array);
    $boolDel = false;
    if (isset($_GET['delete'])){ //if we get delete
        $delete = $_GET['delete'];
        array_splice($array, $delete, 1); //deleting element from array
        $boolDel = true; //to know was item deleted or not
        include 'write.php';
        $size--; // size of array has been changed
    }
    $pageCount = ceil($size/ITEMS_PER_PAGE);
    $currentPage = 0;
    if (isset($_GET['page'])){
        $currentPage = $_GET['page'];
        if($boolDel && $delete == $pageCount * ITEMS_PER_PAGE){
            $currentPage--;
        }
    }
    $start = $currentPage * ITEMS_PER_PAGE;
    $limit = ITEMS_PER_PAGE;
    if (($currentPage == $pageCount - 1) && ($size < $pageCount * ITEMS_PER_PAGE)){
        $limit = $size - $start;
    }
?>
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <h1 class="page-header">Homework 16</h1>
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <?php
                                foreach ($array[0] as $key => $value) {
                                    echo '<th>' . $key . '</th>';
                                }
                            ?>
                            <th>Options</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            for($i=$start;$i<$start + $limit;$i++){
                                echo '<tr><td>' . ($i + 1) . '</td>';
                                foreach ($array[$i] as $key => $value){
                                    echo '<td>' . $value . '</td>';
                                }
                                echo '<td><a href="?page=' . $currentPage . '&delete=' . $i . '">delete row </a><a href="edit.php?id='. $i . '">edit row </a><a href="add.php?id=' . $i . '">add row</a></td>';
                                echo '</tr>';
                            }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="row text-center">
            <div class="col-xs-12">
                <nav>
                    <ul class="pagination">
                        <li>
                            <?php
                                if ($currentPage == 0){
                                    echo '<a style="pointer-events: none; cursor: default;" aria-label="Previous">';
                                } else {
                                    echo '<a href="' . '?page=' . ($currentPage - 1) . '" aria-label="Previous">';
                                }
                            ?>
                                <span aria-hidden="true">&laquo;</span>
                            </a>
                        </li>
                        <?php
                            for($i=0;$i<$pageCount;$i++){
                                if ($i == $currentPage){
                                    $style = 'style="font-weight: bold;"';
                                } else {
                                    $style = 'style="font-weight: 0;"';
                                }
                                echo '<li><a ' . $style . 'href="?page=' . $i . '">' . ($i + 1) . '</a></li>';
                            }
                        ?>
                        <li>
                            <?php
                                if ($currentPage == ($pageCount - 1)){
                                    echo '<a style="pointer-events: none; cursor: default;" aria-label="Next">';
                                } else {
                                    echo '<a href="' . '?page=' . ($currentPage + 1) . '" aria-label="Next">';
                                }
                            ?>
                                <span aria-hidden="true">&raquo;</span>
                            </a>
                        </li>
                    </ul>
                </nav>
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