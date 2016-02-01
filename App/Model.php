<?php

namespace App;


abstract class Model
{
    const TABLE = '';

    protected $id;
    protected static $required = [];

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
            return false;
        }

        $columns = [];
        $masks = [];
        $values = [];
        foreach ( $this as $key => $value) {
            if ( 'id' == $key || 'required' == $key ) {
                continue;
            }
            if ( !$value && $value !== '0' ) {
                if ( in_array($key, static::$required) ) {
                    return false;
                }
                $masks[] = 'NULL';
            } else {
                $masks[] = ':'.$key;
                $values[':'.$key] = $value;
            }
            $columns[] = $key;
        }

        $sql = 'INSERT INTO ' . static::TABLE .
                '('.implode(',',$columns).') '.
                'VALUES ('.implode(',', $masks) .')';
        $db = DB::instance();
        $res = $db->execute($sql, $values);
        $this->id = $db->getLastInsertID();
        return $res;
    }

    public function update()
    {
        if ($this->isNew()) {
            return false;
        }

        $sets = [];
        $values = [];
        foreach ( $this as $key => $value) {
            if ( 'id' == $key || 'required' == $key ) {
                continue;
            }
            if ( !$value && $value !== '0' ) {
                if ( in_array($key, static::$required) ) {
                    return false;
                }
                $sets[] = $key.'=NULL';
            } else {
                $sets[] = $key.'=:'.$key;
                $values[':'.$key] = $value;
            }
            $columns[] = $key;
        }

        $sql = 'UPDATE ' . static::TABLE .
                ' SET ' .implode(',', $sets) .
                ' WHERE ' . 'id='.$this->id;

        $db = DB::instance();
        return $db->execute($sql, $values);

    }

    public function save()
    {
        return $this->isNew() ? $this->insert() : $this->update();
    }

    public function delete()
    {
        $sql = 'DELETE FROM ' .static::TABLE .
                ' WHERE id=' . $this->id;
        $db = DB::instance();
        return $db->execute($sql);
    }

}