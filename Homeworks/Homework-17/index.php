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
    $daysInMonth = [];
    for ($i=0;$i<12;$i++){
        $daysInMonth[] = cal_days_in_month(CAL_GREGORIAN, $i+1, 2016);
    }
?>

    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <h1 class="page-header">Homework 17
            </div>
        </div>
        <div class="row text-center">
            <div class="col-xs-10 col-xs-offset-1">
                <div class="calendar">
                    <?php
                        for($i=0;$i<12;$i++){
                            echo '<div class="line">' . date('M', strtotime('2016-' . ($i+1))) . '</div>';
                            echo '<div class="border">Երկ</div>';
                            echo '<div class="border">Երեք</div>';
                            echo '<div class="border">Չոր</div>';
                            echo '<div class="border">Հինգ</div>';
                            echo '<div class="border">Ուրբ</div>';
                            echo '<div class="border">Շաբ</div>';
                            echo '<div class="border">Կիր</div>';

                            $firstDay = date('N', strtotime('2016-' . ($i + 1) .'-1'));
                            if ($firstDay < 7){
                                for ($k=0;$k<$firstDay-1;$k++){
                                    echo '<div class="border"></div>';
                                }
                            }
                            for ($j=1;$j<=$daysInMonth[$i];$j++){
                                echo '<div class="border">' . $j . '</div>';
                            }
                            echo '<div class="line"></div>';
                        }
                    ?>
                </div>
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
