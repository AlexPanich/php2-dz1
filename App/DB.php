<?php

namespace App;


class DB
{
    protected $dbh;

    public function __construct()
    {
        $this->dbh = new \PDO('mysql:host=localhost;dbname=php2', 'root', '');
    }

    public function execute($sql, $sub = [])
    {
        $sth = $this->dbh->prepare($sql);
        $res = $sth->execute($sub);
        return $res;
    }

    public function query($sql, $class, $sub = [])
    {
        $sth = $this->dbh->prepare($sql);
        $res = $sth->execute($sub);
        if ( false != $res) {
            return $sth->fetchAll(\PDO::FETCH_CLASS, $class);
        }
        return [];
    }
}