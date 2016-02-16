<?php


namespace App;


class Logger
{
    use Singleton;

    protected $file = 'log.txt';

    public function save($str)
    {
        $record = date('Y-d-m H:i:s') . ' ' . $str . PHP_EOL;
        file_put_contents($this->file, $record, FILE_APPEND);
    }

}