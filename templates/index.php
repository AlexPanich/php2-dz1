<!doctype html>
<html lang="ru-RU">
<head>
    <meta charset="UTF-8">
    <title>Главная страница - Новости</title>
</head>
<body>
<h2>Новости нашего городка:</h2>
<ul>
    <? foreach( $news as $article ): ?>
        <li>
            <a href="article.php?id=<?= $article->getId() ?>">
                <h3><?= $article->getTitle() ?></h3>
            </a>
            <p><?= $article->getShortText() ?></p>
        </li>
    <? endforeach ?>
</ul>
</body>
</html>