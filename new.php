<?php


require_once __DIR__.'/autoload.php';

$view = new \App\View();

if ( $_SERVER['REQUEST_METHOD'] == 'POST' ) {
    $article = new \App\Models\Article();

    $title = htmlspecialchars(strip_tags(trim($_POST['title'])));
    $text = htmlspecialchars(strip_tags(trim($_POST['text'])));

    $article->setTitle($title)->setText($text);

    if ($article->save()) {
        header('Location: /admin.php');
        exit();
    }

    $view->article = $article;
    $view->error = \App\Error::instance();
} else {
    $view->error = false;
}

$view->display(__DIR__.'/templates/new.php');
