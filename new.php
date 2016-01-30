<?php

require_once __DIR__.'/autoload.php';

if ( isset($_POST['submit']) ) {
    $article = new \App\Models\Article();

    $title = htmlspecialchars(strip_tags(trim($_POST['title'])));
    $text = htmlspecialchars(strip_tags(trim($_POST['text'])));

    $article->setTitle($title);
    $article->setText($text);

    if ($article->save()) {
        header('Location: /admin.php');
        exit();
    }

    $error = true;
} else {
    $error = false;
}

require_once __DIR__.'/templates/new.php';
