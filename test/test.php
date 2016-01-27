<?php

require_once __DIR__.'/../autoload.php';

$db = new \App\DB();

$sql = 'SELECT * FROM users WHERE id=:id';
$sub = [
    ':id' => 4,
];

$res = $db->execute($sql, $sub);
var_dump($res);

$res = $db->query($sql, \App\Models\User::class, $sub);
var_dump($res);


