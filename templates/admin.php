<!doctype html>
<html lang="ru-RU">
<head>
    <meta charset="UTF-8">
    <title>Панель администратора</title>
    <link rel="stylesheet" href="/templates/css/style.css">
</head>
<body>
<h2>Панель администратора</h2>
<a href="/admin/new"><b>Новая статья</b></a>
<ul>
    <?php foreach ($news as $article): ?>
        <li>
            <a href="/admin/edit/?id=<?= $article->getId() ?>">
                <h3><?= $article->getTitle() ?></h3>
            </a>
            <p><?= $article->getShortText() ?></p>
            <a href="/admin/delete/?id=<?= $article->getId() ?>">Удалить статью</a>
            <?php if ($article->hasAuthor()): ?>
                <blockquote class="author">Автор: <?= $article->getAuthor()->getName(); ?></blockquote>
                <blockquote class="author">Email: <?= $article->getAuthor()->getEmail(); ?></blockquote>
            <?php endif ?>
        </li>
    <?php endforeach ?>
</ul>
<h3>Все авторы</h3>
<?= $table ?>
</body>
</html>
