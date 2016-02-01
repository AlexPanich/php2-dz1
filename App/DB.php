<?php

namespace App;


class DB
{
    use Singleton;

    protected $dbh;
    protected $lastInsertID;
    protected $rowCount;

    public function getLastInsertID()
    {
        return $this->lastInsertID;
    }

    public function getRowCount()
    {
        return $this->rowCount;
    }

    protected function prepareArray($sub) {
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

    public function __construct()
    {
        $config = Config::instance();
        $this->dbh = new \PDO(
            'mysql:host='.$config->data['db']['host'].
            ';dbname='.$config->data['db']['dbname'],
            $config->data['db']['user'],
            $config->data['db']['password']);
        $this->dbh->query('SET NAMES utf8');
    }

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

    public function query($sql, $class, $sub = [])
    {
        $sub = $this->prepareArray($sub);
        $sth = $this->dbh->prepare($sql);
        $res = $sth->execute($sub);
        if ( false != $res) {
            return $sth->fetchAll(\PDO::FETCH_CLASS, $class);
        }
        return [];
    }
}