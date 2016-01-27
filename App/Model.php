<?php

namespace App;


abstract class Model
{
    const TABLE = '';

    public static function findAll()
    {
        $db = new DB();
        return $db->query(
            'SELECT * FROM ' . static::TABLE,
            static::class
        );
    }
}