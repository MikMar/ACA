<?php

/**
 * Created by PhpStorm.
 * User: mikayel
 * Date: 7/31/16
 * Time: 11:50 AM
 */
abstract class AbstractWriter implements IWritable
{
    protected $data;
    protected $headers;

    public function setHeaders()
    {
        foreach ($this->headers as $header => $value) {
            header($header . ':' . $value);
        }    
    }

}