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

//$newArticle = new \App\Models\Article();
//$newArticle->setTitle('Заголовок новой статьи');
//$newArticle->setText('текс статьи текс статьи текс статьитекс статьитекс статьитекс статьимтекс статьитекс статьи');
//$newArticle->save();
//echo $newArticle->getId();
//
$article = \App\Models\Article::findById(12);
//$article->setTitle('Опять Измененный заголовок');
//$article->setText('Снова Измененное содержание статьи тра тра тра тра тра');
//$article->save();
$article->delete();