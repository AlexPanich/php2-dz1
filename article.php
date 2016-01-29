<?php

if ( !isset($_GET['id']) ) {
    header('Location: index.php');
    exit();
}

require_once __DIR__.'/autoload.php';

$id = (int)$_GET['id'];

$article = \App\Models\Article::findById($id);

require_once __DIR__.'/templates/article.php';