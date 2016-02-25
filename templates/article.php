<!doctype html>
<html lang="ru-RU">
<head>
    <meta charset="UTF-8">
    <title>Новость - <?= $article->getTitle() ?></title>
    <link rel="stylesheet" href="/templates/css/style.css">
</head>
<body>
<h2><?= $article->getTitle() ?></h2>
<p><?= $article->getText() ?></p>
<?php if ($article->hasAuthor()): ?>
    <blockquote class="author">Автор: <?= $article->getAuthor()->getName(); ?></blockquote>
<?php else: ?>
    <div class="no-author">Без автора</div>
<?php endif ?>
</body>
</html>