<?php
/**
 * Created by PhpStorm.
 * User: mikayel
 * Date: 7/2/16
 * Time: 7:20 PM
 */

require_once 'connect.php';

class Tools extends Connect
{
    /**
     * @var string
     */
    private $errorMessage;

    /**
     * @return string
     */
    public function getErrorMessage()
    {
        return $this->errorMessage;
    }

    /**
     * Tools constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->errorMessage = '';
    }

    /**
     *@param string $sql SQL query
     *@return array
     */
    public function fetchAssoc($sql)
    {
        try
        {
            $statement = $this->connection->prepare($sql);
            $statement->execute();
            $statement->setFetchMode(PDO::FETCH_ASSOC);
            $result = $statement->fetchAll();
            return $result;
        }
        catch (PDOException $e)
        {
            $this->errorMessage = $e->getMessage();
        }
    }

    public function getAll($table)
    {
        return $this->fetchAssoc("SELECT * FROM " . $table);
    }

    /**
     * @param string $id Tabel
     * @param int $limit Limit
     * @param int $offset Offset
     * @return array
     */
    public function getPostByCategory($id, $limit, $offset){
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

        return $this->fetchAssoc($sql);
    }

    /**
     * @param int $categoryId Category ID
     * @return int
     */
    public function getPageCount($categoryId){
        $sql = 'SELECT count(*) AS count FROM `rel_blog_post_category` WHERE category_id = ' . $categoryId;
        $result = ceil($this->fetchAssoc($sql)[0]['count']/ITEMS_PER_PAGE); // post count / Items per page and ceil to upper value
        return $result;

    }

    public function clear($table){
        $sql = '
        SET FOREIGN_KEY_CHECKS = 0;
        TRUNCATE `' . $table .  '`;
        SET FOREIGN_KEY_CHECKS = 1;';
        try
        {
            $statement = $this->connection->prepare($sql);
            $statement->execute();
        }
        catch (PDOException $e)
        {
            $this->errorMessage = $e->getMessage();
        }
    }

    public function search($word){
        $sql = 'SELECT DISTINCT 
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

       return $this->fetchAssoc($sql);
    }
}

