<?php

if ( !isset($_GET['id']) ) {
    header('Location: index.php');
    exit();
}

require_once __DIR__.'/autoload.php';

$view = new \App\View();

$id = (int)$_GET['id'];

$view->article = \App\Models\Article::findById($id);

$view->display(__DIR__.'/templates/article.php');