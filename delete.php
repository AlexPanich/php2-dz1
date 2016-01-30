<?php

if ( !isset($_GET['id']) ) {
    header('Location: /admin.php');
    exit();
}

require_once __DIR__.'/autoload.php';
$id = (int)$_GET['id'];
$article = \App\Models\Article::findById($id);
$article->delete();

header('Location: /admin.php');



