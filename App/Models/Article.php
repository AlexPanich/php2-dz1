<?php

namespace App\Models;


use App\Model;

class Article extends Model
{
    const TABLE = 'news';

    protected $title;
    protected $text;
    protected $id;

    public function getText()
    {
        return $this->text;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function getId() {
        return $this->id;
    }

    public function getShortText() {
        return mb_substr($this->text, 0, 60) . '...';
    }

    public static function findLastThree() {
        $db = new \App\DB();
        $res = $db->query(
            'SELECT * FROM ' . self::TABLE .
            ' ORDER BY id DESC LIMIT 3',
            self::class
        );
        return $res;
    }
}