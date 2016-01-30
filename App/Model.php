<?php

namespace App;


abstract class Model
{
    const TABLE = '';

    protected $id;

    public static function findAll()
    {
        $db = DB::instance();
        return $db->query(
            'SELECT * FROM ' . static::TABLE,
            static::class
        );
    }

    public static function findById($id)
    {
        $db = DB::instance();
        $res = $db->query(
            'SELECT * FROM ' . static::TABLE .' WHERE id=:id',
            static::class,
            ['id' => $id]
        );

        return !$res ? false : $res[0];
    }

    public function isNew()
    {
        return empty($this->id);
    }

    public function insert()
    {
        if (!$this->isNew()) {
            return;
        }

        $columns = [];
        $values = [];
        foreach ( $this as $key => $value) {
            if ( 'id' == $key ) {
                continue;
            }
            $columns[] = $key;
            $values[':'.$key] = $value;
        }

        $sql = 'INSERT INTO ' . static::TABLE .
                '('.implode(',',$columns).') '.
                'VALUES ('.implode(',', array_keys($values)) .')';

        $db = DB::instance();
        $db->execute($sql, $values);
        $this->id = $db->getLastInsertID();
    }

    public function update()
    {
        if ($this->isNew()) {
            return;
        }

        $sets = [];
        $values = [];
        foreach ( $this as $key => $value) {
            if ( 'id' == $key ) {
                continue;
            }
            $sets[] = $key.'=:'.$key;
            $values[':'.$key] = $value;
        }

        $sql = 'UPDATE ' . static::TABLE .
                ' SET ' .implode(',', $sets) .
                ' WHERE ' . 'id='.$this->id;


        $db = DB::instance();
        $db->execute($sql, $values);

    }

    public function save()
    {
        $this->isNew() ? $this->insert() : $this->update();
    }

}