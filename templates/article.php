<!doctype html>
<html lang="ru-RU">
<head>
    <meta charset="UTF-8">
    <title>Новость - <?= $article->getTitle() ?></title>
</head>
<body>
<h2><?= $article->getTitle() ?></h2>
<p><?= $article->getText() ?></p>
</body>
</html>