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

    public static function findLastN($n) {
        $db = new \App\DB();
        $sql = sprintf('SELECT * FROM ' . self::TABLE .
            ' ORDER BY id DESC LIMIT %d', $n);
        $res = $db->query(
            $sql,
            self::class
        );
        return $res;
    }
}