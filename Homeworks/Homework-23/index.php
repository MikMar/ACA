<?php
$errorMessage = '';
if (isset($_GET['message'])){
    $errorMessage = $_GET['message'];
}
define('PATH', 'img/'); //for lecturer profile pics
require_once 'tools.php';

$idIsSet = false;
if(isset($_GET['id'])){
    $id = $_GET['id']; //page ID
    $idIsSet = true;
    $tempError = $errorMessage; // after get function we lose errorMessage from delete
    // if we delete error message from get it will be solved but we will lose errors of db reading
    // that's why we save error from delete
    $array = get($id); //reading from db
    if ($errorMessage == ''){ // if there was no error from reading
        $errorMessage = $tempError; // we will get error from deleting
    }
    // processing add for each table
    foreach ($array[0] as $key => $value) {

        if (strpos($key, 'img') !== false){ //processing file upload

            if (!empty($_FILES[$key])){
                $uploadFile = $_FILES[$key];
                if($uploadFile['error'] != 0){
                } else {
                    $name = $uploadFile['name']; //file will be uploaded in current folder with first name

                    $ext = new SplFileInfo($name); //getting extension
                    $name = date("Y_m_d_H_i_s") . '.' . $ext->getExtension(); //giving unique name to file
                    $addArray[] = $name; //pushing to addArray to write then to db
                    $success = move_uploaded_file($uploadFile['tmp_name'], PATH . $name);

                    if (!$success){
                        echo '<p>unable to safe file</p>';
                        die;
                    }

                    chmod(PATH . $name, 0666);
                    continue;
                }
            }
         } if(isset($_POST[$key])){
                $addArray[] = $_POST[$key];
        }
    }
    if (isset($addArray)){
        add($id, $addArray); //writing to db
        if ($errorMessage == ''){
            $errorMessage = 'Added successfully';
        }
        $tempError = $errorMessage; // after get function we lose errorMessage from add
        // if we delete error message from get it will be solved but we will lose errors of db reading
        // that's why we save error from add
        $array = get($id); //reading from db to see print changed table
        if ($errorMessage == ''){ // if there was no error from reading
            $errorMessage = $tempError; // we will get error from adding
        }
    }

    //pagination
    define('ITEMS_PER_PAGE', '10');

    $size = count($array);
    $pageCount = ceil($size/ITEMS_PER_PAGE);
    $currentPage = 0;
    if (isset($_GET['page'])){
        $currentPage = $_GET['page'];
    }
    $start = $currentPage * ITEMS_PER_PAGE;
    $limit = ITEMS_PER_PAGE;
    if (($currentPage == $pageCount - 1) && ($size < $pageCount * ITEMS_PER_PAGE)){
        $limit = $size - $start;
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
    <title>ACA</title>

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
    <?php
        if ($errorMessage != ''){
            echo
            '<div class="alert alert-warning" id="_alert">
                <a href="#" class="close">&times;</a>' . $errorMessage .
            '</div>';
        }
        include_once 'header.php';

    ?>
    <div class="container margin-top">
        <div class="row">
            <div class="col-xs-12">
                <?php //if it is fist page
                    if (!$idIsSet){
                        echo '<h1 class="text-center">WELCOME ACA</h1>';
                        die; //finish page here
                    }
                ?>
                <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">
                    <span class="glyphicon glyphicon-plus"></span>
                    Add
                </button>
                <!-- Modal -->
                <div class="modal fade" id="myModal" role="dialog">
                    <div class="modal-dialog">
                        <!-- Modal content-->
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title">Add <?php echo $id; ?></h4>
                            </div>
                            <div class="modal-body">
                                <form method="post" enctype="multipart/form-data">
                                    <div class="input-group">
                                        <input type="hidden" name="id" value="<?php echo $id; //to save id value on form submit ?>">
                                        <?php //generating dynamic form for each table
                                            foreach ($array[0] as $key => $value){
                                                if (strpos($key, 'id') !== false){ //do not print id column
                                                    continue;
                                                }
                                                if (strpos($key, 'img') !== false){ //if it is field for img we should create file upload filed
                                                    echo '<input type="file" name="' . $key .'">';
                                                    continue;
                                                }
                                                if (strcmp($key, 'course_name') == 0){ //if it is course name field with should create selection from course name from course table
                                                    echo '<select class="form-control" id="sel1" name="' . $key .'">';
                                                    $options = get('course');
                                                    foreach ($options as $oKey => $oValue){
                                                        echo '<option>' . $oValue['name'] .'</option>';
                                                    }
                                                    echo '</select>';
                                                    continue;
                                                }
                                                echo '<input type="text" name="'. $key . '" placeholder="' . str_replace('_', ' ', $key) .'" class="form-control" aria-describedby="basic-addon1">';
                                            }
                                        ?>
                                        <button type="submit" class="btn btn-default">Add</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <table class="table table-striped text-center">
                    <thead>
                        <?php
                            foreach ($array[0] as $key => $value){
                                if (strpos($key, 'id') !== false){ //do not print id column
                                    continue;
                                }
                                echo '<th class="text-center">'. str_replace('_', ' ', $key) .'</th>';
                            }
                            echo '<th>options</th>';
                        ?>
                    </thead>
                    <tbody>
                        <?php
                            for ($i=$start;$i<$start+$limit;$i++){ //for each row
                                echo '<tr>';
                                foreach ($array[$i] as $key => $value){ //print row cols
                                    if (strpos($key, 'id') !== false){ //do not print id column
                                        $col = $value; // taking value to delete
                                        continue;
                                    }
                                    if( //echo image if value is image name
                                        preg_match('/\w.jpg/', $value) ||
                                        preg_match('/\w.png/', $value) ||
                                        preg_match('/\w.gif/', $value)
                                    ){
                                        echo '<td><img class="profile-pic" src=" ' . PATH . $value . '"></td>';
                                    } else {
                                        echo '<td>' . $value . '</td>';
                                    }
                                }

                                echo '<td><a href="delete.php?table=' . $id . '&col='. $col . '">delete</a></td>'; //deleting
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
                                echo '<a class="pagination-lock" aria-label="Previous">';
                            } else {
                                echo '<a href="' . '?id=' . $id . '&page=' . ($currentPage - 1) . '" aria-label="Previous">';
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
                            echo '<li><a ' . $style . 'href="?id=' . $id . '&page=' . $i . '">' . ($i + 1) . '</a></li>';
                        }
                        ?>
                        <li>
                            <?php
                            if ($currentPage == ($pageCount - 1)){
                                echo '<a class="pagination-lock" aria-label="Next">';
                            } else {
                                echo '<a href="' . '?id=' . $id . '&page=' . ($currentPage + 1) . '" aria-label="Next">';
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
    <!-- build
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
    -->
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="JS/script.js"></script>
</body>
</html>
