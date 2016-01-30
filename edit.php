<?php

require_once __DIR__.'/autoload.php';

if ( $_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = (int)$_POST['id'];
    $title = htmlspecialchars(strip_tags(trim($_POST['title'])));
    $text = htmlspecialchars(strip_tags(trim($_POST['text'])));
    $article = \App\Models\Article::findById($id);
    $article->setTitle($title);
    $article->setText($text);
    $article->save();
    header('Location: /admin.php');
    exit();
}

if ( !isset($_GET['id']) ) {
    header('Location: /admin.php');
    exit();
}

$id = (int)$_GET['id'];
$article = \App\Models\Article::findById($id);

require_once __DIR__.'/templates/edit.php';


