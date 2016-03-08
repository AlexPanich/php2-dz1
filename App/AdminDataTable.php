<?php


namespace App;


class AdminDataTable
{
    protected $models = [];
    protected $func = [];

    public function __construct(array $models, array $func)
    {
        $this->models = $models;
        $this->func = $func;
    }

    public function render()
    {

    }
}