<?php

/**
 * Created by PhpStorm.
 * User: mikayel
 * Date: 7/31/16
 * Time: 11:11 AM
 */

spl_autoload_register(function($class_name) {
    require $class_name . ".php";
});

class Book implements IWritable
{
    /**
     * @var string
     */
    public $title;
    /**
     * @var string
     */
    public $author;
    /**
     * @var int
     */
    public $year;


    public function my_print()
    {
        echo $this->title . ' ' . $this->author . ' ' . $this->year;
    }

    public function getJSON()
    {
        // TODO: Implement getJSON() method.

        $temp = [
          'title' => $this->title,
          'author' => $this->author,
          'year' => $this->year
        ];

        return json_encode($this);
    }

    public function getXML()
    {
        // TODO: Implement getXML() method.

        $temp = [
            'title' => $this->title,
            'author' => $this->author,
            'year' => $this->year
        ];
    }
}