<?php

require_once __DIR__.'/autoload.php';

$view = new \App\View();
$view->news = \App\Models\Article::findLastN(3);

$view->display(__DIR__.'/templates/index.php');


