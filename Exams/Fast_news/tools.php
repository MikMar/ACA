<?php
/**
 * Created by PhpStorm.
 * User: mikayel
 * Date: 7/2/16
 * Time: 7:20 PM
 */

require_once 'connect.php';


function getAll($table){
    $temp = [];
    global $conn;
    global $errorMessage;
    $sql = "SELECT * FROM " . $table;
    $result = $conn->query($sql);
    $errorMessage = mysqli_error($conn);
    if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
            $temp[] = $row;
        }
    }
    return $temp;
}

function getNewsByCategory($id, $limit, $offset){
    global $conn;
    $temp = [];
    $sql = '
        SELECT 
            `news`.`date` AS date,
            `news`.`title`,
            `news`.`content`
        FROM news
        WHERE category_id = ' . $id . '
        LIMIT ' . $limit . ', ' . $offset;
    $result = $conn->query($sql);
    if ($result->num_rows > 0){
        while ($row = $result->fetch_assoc()){
            $temp[] = $row;
        }
    }
    return $temp;
}

function clear($table){
    global $conn;
    $sql = '
        SET FOREIGN_KEY_CHECKS = 0;
        TRUNCATE `' . $table .  '`;
        SET FOREIGN_KEY_CHECKS = 1;';
    $conn->query($sql);
}

function search($word){
    global $conn;
    $temp = [];
    $sql = '
        SELECT DISTINCT 
            `blog_post`.`date_created` AS date,
            `blog_post`.`title`,
            `blog_post`.`content`,
            `author`.`name` AS author
            FROM rel_keyword_in_post JOIN keywords
            ON rel_keyword_in_post.keyword_id = keywords.id
            JOIN blog_post
            ON blog_post.id = rel_keyword_in_post.post_id
            JOIN author
            ON author.id = blog_post.author_id
            WHERE keywords.word LIKE "%'. $word . '%"
    ';
    $result = $conn->query($sql);
    if ($result->num_rows > 0){
        while ($row = $result->fetch_assoc()){
            $temp[] = $row;
        }
    }
    return $temp;
}

function add($table, $tempArray){
    global $conn;
    global $errorMessage;
    $query = '';
    foreach ($tempArray as $key => $value){
        $query .= "'" . $value . "', ";
    }
    $query = substr($query, 0, -2);
    $sql = "INSERT INTO $table VALUE ($query)";
    $conn->query($sql);
    $errorMessage = mysqli_error($conn);

}

function delete($table, $col){
    global $conn;
    global $errorMessage;
    //processing image delete
    $sql = 'SELECT * FROM ' . $table . ' WHERE id=' .$col;
    $result = $conn->query($sql)->fetch_assoc();
    var_dump($result);
    foreach ($result as $key => $value){
        if (strpos($key, 'img') !== false){ //if it is field for image we should delete image before deleting row
            if (!unlink(PATH . '/' . $value)){ //deleting file with that name from img folder
                die;
            }
        }
    }

    $sql = 'DELETE FROM ' . $table . ' WHERE id=' .$col;
    $conn->query($sql);
    $errorMessage = mysqli_error($conn);
    var_dump($errorMessage);
    return $errorMessage;
}