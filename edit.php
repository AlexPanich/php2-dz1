<?php

require_once __DIR__.'/autoload.php';

if ( $_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = (int)$_POST['id'];
    $title = htmlspecialchars(strip_tags(trim($_POST['title'])));
    $text = htmlspecialchars(strip_tags(trim($_POST['text'])));
    $article = \App\Models\Article::findById($id);
    $article->setTitle($title)->setText($text);

    if ( $article->save() ) {
        header('Location: /admin.php');
        exit();
    } else {
        $view = new \App\View();
        $view->article = $article;
        $view->error = \App\Error::instance();
    }
} else {

    if (!isset($_GET['id'])) {
        header('Location: /admin.php');
        exit();
    }

    $view = new \App\View();
    $view->error = false;
    $id = (int)$_GET['id'];
    $view->article = \App\Models\Article::findById($id);
}
$view->display(__DIR__.'/templates/edit.php');


