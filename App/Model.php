<?php

namespace App;


/**
 * Class Model
 * @package App
 */
abstract class Model
{
    const TABLE = '';

    protected $id;
    protected static $required = [];

    /**
     * @return array
     */
    public static function findAll()
    {
        /** @var DB $db */
        $db = DB::instance();
        return $db->query(
            'SELECT * FROM ' . static::TABLE,
            static::class
        );
    }

    /**
     * @param integer $id
     * @return Model|bool
     */
    public static function findById($id)
    {
        /** @var DB $db */
        $db = DB::instance();
        $res = $db->query(
            'SELECT * FROM ' . static::TABLE .' WHERE id=:id',
            static::class,
            [':id' => $id]
        );

        return !$res ? false : $res[0];
    }

    /**
     * @return bool
     */
    public function isNew()
    {
        return empty($this->id);
    }

    /**
     * @return bool
     */
    public function insert()
    {
        if (!$this->isNew()) {
            return false;
        }

        $columns = [];
        $masks = [];
        $values = [];
        foreach ( $this as $key => $value) {
            if ( 'id' == $key || 'required' == $key || 'author' == $key ) {
                continue;
            }
            if ( !$value && $value !== '0' ) {
                if ( in_array($key, static::$required) ) {

                    /** @var Error $error */
                    $error = Error::instance();
                    $error[] = $key;
                }
                $masks[] = 'NULL';
            } else {
                $masks[] = ':'.$key;
                $values[':'.$key] = $value;
            }
            $columns[] = $key;
        }
        if ( isset($error) ) {
            return false;
        }

        $sql = 'INSERT INTO ' . static::TABLE .
                '('.implode(',',$columns).') '.
                'VALUES ('.implode(',', $masks) .')';

        /** @var DB $db */
        $db = DB::instance();
        $res = $db->execute($sql, $values);
        $this->id = $db->getLastInsertID();
        return $res;
    }

    /**
     * @return bool
     */
    public function update()
    {
        if ($this->isNew()) {
            return false;
        }

        $sets = [];
        $values = [];
        foreach ( $this as $key => $value) {
            if ( 'id' == $key || 'required' == $key || 'author' == $key ) {
                continue;
            }
            if ( !$value && $value !== '0' ) {
                if ( in_array($key, static::$required) ) {

                    /** @var Error $error */
                    $error = Error::instance();
                    $error[] = $key;
                }
                $sets[] = $key.'=NULL';
            } else {
                $sets[] = $key.'=:'.$key;
                $values[':'.$key] = $value;
            }
            $columns[] = $key;
        }
        if ( isset($error) ) {
            return false;
        }
        $values[':id'] = $this->id;
        $sql = 'UPDATE ' . static::TABLE .
                ' SET ' .implode(',', $sets) .
                ' WHERE id=:id';

        /** @var DB $db */
        $db = DB::instance();
        return $db->execute($sql, $values);

    }

    /**
     * @return bool
     */
    public function save()
    {
        return $this->isNew() ? $this->insert() : $this->update();
    }

    /**
     * @return bool
     */
    public function delete()
    {
        $sql = 'DELETE FROM ' .static::TABLE .
                ' WHERE id=:id';

        $values[':id'] = $this->id;

        /** @var DB $db */
        $db = DB::instance();
        return $db->execute($sql, $values);
    }

}