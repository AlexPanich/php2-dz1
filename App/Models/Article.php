<?php

namespace App\Models;

use App\Model;
use App\DB;

class Article extends Model
{
    const TABLE = 'news';

    protected $title;
    protected $text;
    protected static $required = ['title'];
    protected $author_id;

    public function setTitle($title)
    {
        $this->title = $title;
        return $this;
    }

    public function setText($txt)
    {
        $this->text = $txt;
        return $this;
    }

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
        $db = DB::instance();
        $sql = sprintf('SELECT * FROM ' . self::TABLE .
            ' ORDER BY id DESC LIMIT %d', $n);
        $res = $db->query(
            $sql,
            self::class
        );
        return $res;
    }

    public function __get($name) {
        if ( $name == 'authors' ) {
            if (!empty($this->author_id)) {
                return Author::findById($this->author_id);
            }
        }
        return null;
    }

    public function hasAuthors()
    {
        return !empty($this->author_id);
    }
}