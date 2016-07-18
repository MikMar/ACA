<?php
/**
 * Created by PhpStorm.
 * User: mikayel
 * Date: 7/13/16
 * Time: 7:34 PM
 */

require_once 'tools.php';

clear('rel_keyword_in_post');

$array = getAll('blog_post'); //writing into array all blog info
$keyWords = [];

foreach($array as $key => $value){
    $words = explode(' ', $value['content']); // getting array with all words from each post content
    array_merge($words, explode(' ', $value['title'])); // and all words from title;
    $keyWords[$value['id']] = [];
    for($i=0;$i<count($words);$i++){ // creating keywords array with each word its count and post id from wich it was taken
        $words[$i] = preg_replace("/\W(?=,.*\.[^.]*$)/", "", $words[$i]);
        $words[$i] = strtolower($words[$i]); //making lowercase

        if (isset( $keyWords[$value['id']][$words[$i]]) ){
            $keyWords[$value['id']][$words[$i]]++;
        } else {
            $keyWords[$value['id']][$words[$i]] = 1;
        }
    }
}

foreach ($keyWords as $key => $value){
    foreach ($value as $keyWord => $count) {
        $sql = 'INSERT INTO `keywords` (`word`) VALUE("' . $keyWord . '")'; // writing all words in keywords table
        $conn->query($sql);
        $lastInsertId = mysqli_insert_id($conn); // getting id of last keyword to write in rel keywords in post table
        if ($lastInsertId == 0) { // word should be unique in keywords table,
            // // if duplicate value was set lastinsertId should be equal to already written word id
            $sql = 'SELECT id FROM `keywords` WHERE word = "' . $keyWord . '"';
            $lastInsertId = $conn->query($sql);
            if ($lastInsertId){
                $lastInsertId = $lastInsertId->fetch_assoc();
                $lastInsertId = $lastInsertId['id'];
            }
        }
        if ($lastInsertId != 0){
            $sql = 'INSERT INTO `rel_keyword_in_post` VALUES("' . $lastInsertId . '", "' . $key . '", "' . $count . '")';
            $conn->query($sql);
            echo (mysqli_error($conn)) . PHP_EOL;
        }

    }
}

//$sql = 'INSERT INTO `keywords in post` VALUES("' . $temp[$i] . '","' . $value['id'] . '")';
//$conn->query($sql);*/