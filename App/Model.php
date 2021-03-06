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


    public static function findAllWithGenerator()
    {
        /** @var  $db */
        $db = DB::instance();

        return $db->queryEach(
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
            'SELECT * FROM ' . static::TABLE . ' WHERE id=:id',
            static::class,
            [':id' => (int)$id]
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
     * @throws MultiException
     */
    public function insert()
    {
        if (!$this->isNew()) {
            return false;
        }

        $columns = [];
        $masks = [];
        $values = [];
        foreach ($this as $key => $value) {
            if ('id' == $key || 'required' == $key || 'author' == $key) {
                continue;
            }
            if (!$value && $value !== '0') {
                $masks[] = 'NULL';
            } else {
                $masks[] = ':' . $key;
                $values[':' . $key] = $value;
            }
            $columns[] = $key;
        }

        $sql = 'INSERT INTO ' . static::TABLE .
            '(' . implode(',', $columns) . ') ' .
            'VALUES (' . implode(',', $masks) . ')';

        /** @var DB $db */
        $db = DB::instance();
        $res = $db->execute($sql, $values);
        $this->id = $db->getLastInsertID();
        return $res;
    }

    /**
     * @return bool
     * @throws MultiException
     */
    public function update()
    {
        if ($this->isNew()) {
            return false;
        }

        $sets = [];
        $values = [];
        foreach ($this as $key => $value) {
            if ('id' == $key || 'required' == $key || 'author' == $key) {
                continue;
            }
            if (!$value && $value !== '0') {
                $sets[] = $key . '=NULL';
            } else {
                $sets[] = $key . '=:' . $key;
                $values[':' . $key] = $value;
            }
            $columns[] = $key;
        }
        $values[':id'] = $this->id;
        $sql = 'UPDATE ' . static::TABLE .
            ' SET ' . implode(',', $sets) .
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
        $sql = 'DELETE FROM ' . static::TABLE .
            ' WHERE id=:id';

        $values[':id'] = $this->id;

        /** @var DB $db */
        $db = DB::instance();
        return $db->execute($sql, $values);
    }

}