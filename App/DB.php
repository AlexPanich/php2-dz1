<?php

namespace App;


class DB
{
    protected $dbh;

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
        $this->dbh = new \PDO('mysql:host=localhost;dbname=php2', 'root', '');
        $this->dbh->query('SET NAMES utf8');
    }

    public function execute($sql, $sub = [])
    {
        $sub = $this->prepareArray($sub);
        $sth = $this->dbh->prepare($sql);
        $res = $sth->execute($sub);
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