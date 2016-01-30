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


$config = \App\Config::instance();

echo $config->data['db']['host'];

$article = new \App\Models\Article();
$article->setTitle('Заголовок новой статьи');
$article->setText('текс статьи текс статьи текс статьитекс статьитекс статьитекс статьимтекс статьитекс статьи');
$article->insert();
echo $article->getId();
