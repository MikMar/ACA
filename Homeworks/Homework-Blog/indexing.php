<?php
/**
 * Created by PhpStorm.
 * User: mikayel
 * Date: 7/13/16
 * Time: 7:34 PM
 */

require_once 'tools.php';

$array = getAll('blog_post');
$keyWords = [];

foreach($array as $key => $value){
    $temp = explode(' ', $value['content']);
    for($i=0;$i<count($temp);$i++){
        if (isset($keyWords[$temp[$i]])){
            $keyWords[$temp[$i]]['count']++;
        } else {
            $keyWords[$temp[$i]]['count'] = 1;
            $keyWords[$temp[$i]]['id'] = $value['id'];
        }
    }
}

foreach ($keyWords as $key => $value){
    $sql = 'INSERT INTO `keywords` (`word`) VALUE("' . $key . '")';
    $conn->query($sql);
    $lastInsertId = mysqli_insert_id($conn);
    for($i=0;$i<$value['count'];$i++){
        $sql = 'INSERT INTO `keyword_in_post` VALUES("' . $lastInsertId . '","' . $value['id'] .   '")';
        $conn->query($sql);
    }
}


//$sql = 'INSERT INTO `keywords in post` VALUES("' . $temp[$i] . '","' . $value['id'] . '")';
//$conn->query($sql);*/