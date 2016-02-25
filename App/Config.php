<?php


namespace App;


/**
 * Class Config
 * @package App
 */
class Config
{
    use Singleton;

    public $data;

    /**
     * Constructor
     */
    protected function __construct()
    {
        $this->data = include(__DIR__ . '/../config.php');
    }
}