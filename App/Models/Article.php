<?php

namespace App\Models;

use App\Model;
use App\DB;
use App\MultiException;

/**
 * Class Article
 * @property Author|null author
 * @package App\Models
 */
class Article extends Model
{
    const TABLE = 'news';

    protected $title;
    protected $text;
    protected static $required = ['title', 'text'];
    protected $author_id;
    protected $author;

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
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getShortText()
    {
        return mb_substr($this->text, 0, 60) . '...';
    }

    /**
     * @param integer $n
     * @return array
     */
    public static function findLastN($n)
    {
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
    public function __get($name)
    {
        switch ($name) {
            case 'authors':
                if (!empty($this->author_id)) {
                    return Author::findById($this->author_id);
                }
                return null;
            default:
                return null;
        }
    }

    /**
     * @return Author|null
     */
    public function getAuthor()
    {
        if (empty($this->author)) {
            $this->author = $this->authors;
        }
        return $this->author;
    }

    /**
     * @param string $name
     * @return bool
     */
    public function __isset($name)
    {
        switch ($name) {
            case 'authors':
                return !empty($this->author_id);
                break;
            default:
                return false;
        }
    }

    /**
     * @return bool
     */
    public function hasAuthor()
    {
        return isset($this->authors);
    }

    public function fill(array $array = [])
    {
        foreach ($array as $key => $value) {
            if (property_exists(self::class, $key)) {
                $this->$key = htmlentities(trim(strip_tags($value)), ENT_QUOTES);
            }
        }
        foreach ($this as $key => $value) {
            if (!$value && $value !== '0') {
                if (in_array($key, static::$required)) {

                    /** @var MultiException $error */
                    if (!isset($error)) {
                        $error = new MultiException();
                    }
                    $error[] = new \Exception($key);
                }
            }
        }
        if (isset($error)) {
            throw $error;
        }

    }
}