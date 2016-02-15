<?php


namespace App;


trait TCollection
{
    protected $data = [];
    protected $position = 0;



    public function offsetExists($offset)
    {
        return isset($this->data[$offset]);
    }


    public function offsetGet($offset)
    {
        return isset($this->data[$offset]) ? $this->data[$offset] : null;
    }


    public function offsetSet($offset, $value)
    {
        if ( is_null($offset) ) {
            $this->data[] = $value;
        } else {
            $this->container[$offset] = $value;
        }
    }


    public function offsetUnset($offset)
    {
        unset($this->data[$offset]);
    }


    public function current()
    {
        return $this->data[$this->position];
    }


    public function next()
    {
        $this->position++;
    }


    public function key()
    {
        return $this->position;
    }


    public function valid()
    {
        return isset($this->data[$this->position]);
    }


    public function rewind()
    {
        $this->position = 0;
    }

}