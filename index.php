<?php

require_once __DIR__.'/autoload.php';

$news = \App\Models\Article::findLastN(3);

require_once __DIR__.'/templates/index.php';

