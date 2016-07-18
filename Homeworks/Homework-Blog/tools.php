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

function getPostByCategory($id, $limit, $offset){
    global $conn;
    $temp = [];
    $sql = '
        SELECT 
            `blog_post`.`date_created` AS date,
            `blog_post`.`title`,
            `blog_post`.`content`,
            `author`.`name` AS author
        FROM blog_post JOIN rel_blog_post_category
        ON blog_post.id = rel_blog_post_category.blog_post_id
        JOIN blog_post_category
        ON rel_blog_post_category.category_id = blog_post_category.id
        JOIN author
        ON blog_post.author_id = author.id
        WHERE blog_post_category.id = ' . $id . '
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