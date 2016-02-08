<!doctype html>
<html lang="ru-RU">
<head>
    <meta charset="UTF-8">
    <title>Главная страница - Новости</title>
    <link rel="stylesheet" href="templates/css/style.css">
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
            <?php if ( $article->hasAuthors() ): ?>
                <blockquote class="author">Автор: <?= $article->authors; ?></blockquote>
            <?php endif ?>
        </li>
    <?php endforeach ?>
</ul>
</body>
</html>