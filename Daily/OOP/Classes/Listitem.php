<?php

/**
 * Created by PhpStorm.
 * User: mikayel
 * Date: 7/20/16
 * Time: 8:34 PM
 */
class Listitem
{
    /**
     * @var string
     */
    private $content;

    /**
     * @param string $content
     */
    public function setContent($content)
    {
        $this->content = $content;
    }

    public function draw()
    {
        echo '<li>' . $this->content . '</li>';
    }
}