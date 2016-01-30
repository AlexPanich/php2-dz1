<!doctype html>
<html lang="ru-RU">
<head>
    <meta charset="UTF-8">
    <title>Главная страница - Новости</title>
</head>
<body>
<a href="admin.php">Панель администратора</a>
<h2>Новости нашего городка:</h2>
<ul>
    <?php foreach( $news as $article ): ?>
        <li>
            <a href="article.php?id=<?= $article->getId() ?>">
                <h3><?= $article->getTitle() ?></h3>
            </a>
            <p><?= $article->getShortText() ?></p>
        </li>
    <?php endforeach ?>
</ul>
</body>
</html>