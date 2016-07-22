<?php

require_once "Listitem.php";
/**
 * Created by PhpStorm.
 * User: mikayel
 * Date: 7/20/16
 * Time: 8:36 PM
 */
class HTMLlist
{
    const ORDERED_LIST = 'ol';
    const UNORDERED_LIST = 'ul';

    /**
     * @var Listitem[]
     */
    private $listItems;

    /**
     * @var string
     */
    private $type;

    /**
     * HTMLlist constructor.
     * @param $listItems
     */
    public function __construct()
    {
        $this->listItems = [];
        $this->type = 'ul';
    }

    public function addItem(Listitem $item)
    {
        $this->listItems[] = $item;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param string $type
     */
    public function setType($type)
    {   if($type == self::ORDERED_LIST || $type == self::UNORDERED_LIST){
            $this->type = $type;
        }

    }



    public function draw()
    {
        echo '<' . $this->type . '>';
        foreach ($this->listItems as $item){
            $item->draw();
        }
        echo '</' . $this->type . '>';
    }

}