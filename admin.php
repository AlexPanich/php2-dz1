<?php

require_once __DIR__.'/autoload.php';

$news = \App\Models\Article::findAll();

require_once __DIR__.'/templates/admin.php';

