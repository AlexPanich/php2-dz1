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

    public static function findById($id)
    {
        $db = new DB();
        $res = $db->query(
            'SELECT * FROM ' . static::TABLE .' WHERE id=:id',
            static::class,
            [':id' => $id]
        );

        return !$res ? false : $res[0];
    }



}