<?php

namespace App;


trait Magic
{
    protected $data = [];

    function __set($name, $value)
    {
        $this->data[$name] = $value;
        return $this;
    }

    function __get($name)
    {
        return $this->data[$name];
    }

    function __isset($name)
    {
        return array_key_exists($name, $this->data);
    }
}