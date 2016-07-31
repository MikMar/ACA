<?php

/**
 * Created by PhpStorm.
 * User: mikayel
 * Date: 7/31/16
 * Time: 11:47 AM
 */
class JsonWriter extends AbstractWriter
{


    /**
     * JsonWriter constructor.
     */
    public function __construct()
    {
        $this->headers =[
          'Content-Type' => 'application/json'
        ];
    }

    public function setData($data)
    {
        $this->data = $data;
    }

    public function getData()
    {
        $this->setHeaders();
        return json_encode($this->data);
    }

}