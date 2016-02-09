<?php

namespace App\Models;

use App\Model;
use App\DB;

/**
 * Class Article
 * @package App\Models
 */
class Article extends Model
{
    const TABLE = 'news';

    protected $title;
    protected $text;
    protected static $required = ['title', 'text'];
    protected $author_id;

    /**
     * @param  string $title
     * @return Article $this
     */
    public function setTitle($title)
    {
        $this->title = $title;
        return $this;
    }

    /**
     * @param string $txt
     * @return Article $this
     */
    public function setText($txt)
    {
        $this->text = $txt;
        return $this;
    }

    /**
     * @return string
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @return integer
     */
    public function getId() {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getShortText() {
        return mb_substr($this->text, 0, 60) . '...';
    }

    /**
     * @param integer $n
     * @return array
     */
    public static function findLastN($n) {
        /** @var DB $db */
        $db = DB::instance();
        $sql = sprintf('SELECT * FROM ' . self::TABLE .
            ' ORDER BY id DESC LIMIT %d', $n);
        $res = $db->query(
            $sql,
            self::class
        );
        return $res;
    }

    /**
     * @param string $name
     * @return Author|null
     */
    public function __get($name) {
        if ( $name == 'authors' ) {
            if ( !empty($this->author_id) ) {
                return Author::findById($this->author_id);
            }
        }
        return null;
    }

    public function __isset($name)
    {
        return $name == 'authors' ? !empty($this->author_id) ? true: false : false;
    }

    /**
     * @return bool
     */
    public function hasAuthors()
    {
        return !empty($this->author_id);
    }
}