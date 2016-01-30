<!doctype html>
<html lang="ru-RU">
<head>
    <meta charset="UTF-8">
    <title>Панель администратора</title>
</head>
<body>
<h2>Панель администратора</h2>
<a href="new.php"><b>Новая статья</b></a>
<ul>
    <?php foreach( $news as $article ): ?>
        <li>
            <a href="edit.php?id=<?= $article->getId() ?>">
                <h3><?= $article->getTitle() ?></h3>
            </a>
            <p><?= $article->getShortText() ?></p>
            <a href="delete.php?id=<?= $article->getId() ?>">Удалить статью</a>
        </li>
    <?php endforeach ?>
</ul>
</body>
</html>
