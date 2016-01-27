<?php

require_once __DIR__.'/autoload.php';

$news = \App\Models\Article::findLastThree();

require_once __DIR__.'/templates/index.php';

