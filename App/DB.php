<?php

namespace App;


/**
 * Class DB
 * @package App
 */
class DB
{
    use Singleton;

    /**
     * @var \PDO
     */
    protected $dbh;
    /**
     * @var integer
     */
    protected $lastInsertID;
    /**
     * @var integer
     */
    protected $rowCount;

    /**
     * @return integer
     */
    public function getLastInsertID()
    {
        return $this->lastInsertID;
    }

    /**
     * @return integer
     */
    public function getRowCount()
    {
        return $this->rowCount;
    }

    /**
     * @param array $sub
     * @return array
     */
    protected function prepareArray($sub)
    {
        if (!$sub) {
            return $sub;
        }
        $arr = [];
        foreach ($sub as $key => $elem) {
            if ($key[0] == ':') {
                $arr[$key] = $elem;
            } else {
                $arr[':' . $key] = $elem;
            }
        }
        return $arr;
    }

    /**
     * Constructor
     */
    protected function __construct()
    {
        $config = Config::instance();
        try {
            $this->dbh = new \PDO(
                'mysql:host=' . $config->data['db']['host'] .
                ';dbname=' . $config->data['db']['dbname'],
                $config->data['db']['user'],
                $config->data['db']['password']);
        } catch (\PDOException $e) {
            throw new \App\Exception\DB('Ошибка базы данных: ' . $e->getMessage());
        }
        $this->dbh->query('SET NAMES utf8');
    }

    /**
     * @param string , $sql
     * @param array $sub
     * @return bool
     */
    public function execute($sql, $sub = [])
    {
        $sth = $this->dbh->prepare($sql);
        $res = $sth->execute($sub);
        if (false != $res) {
            $this->lastInsertID = $this->dbh->lastInsertId();
            $this->rowCount = $sth->rowCount();
        }
        return $res;
    }

    /**
     * @param string $sql
     * @param  $class
     * @param array $sub
     * @return array
     */
    public function query($sql, $class, $sub = [])
    {
        $sub = $this->prepareArray($sub);
        $sth = $this->dbh->prepare($sql);
        $res = $sth->execute($sub);
        if (false != $res) {
            return $sth->fetchAll(\PDO::FETCH_CLASS, $class);
        }
        return [];
    }

    public function queryEach($sql, $class, $sub = [])
    {
        $sub = $this->prepareArray($sub);
        $sth = $this->dbh->prepare($sql);
        $res = $sth->execute($sub);
        $result = [];
        if (false != $res) {
            $sth->setFetchMode(\PDO::FETCH_CLASS, $class);
            while($record = $sth->fetch(\PDO::FETCH_CLASS)) {
                $result[] = $record;
            }
        }
        return $result;
    }
}