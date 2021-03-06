<!doctype html>
<html lang="ru-RU">
<head>
    <meta charset="UTF-8">
    <title>Панель администратора - редактирование статьи</title>
    <link rel="stylesheet" href="/templates/css/style.css">
</head>
<body>
<h2 class="page-title">Панель администратора - редактирование новой статьи</h2>

<?php if ($error): ?>
    <div class="error">Внимание! Необходимо заполнить все обязательные (
        <?php foreach ($error as $currentError): ?>
            <?= $currentError->getMessage() ?>
        <?php endforeach ?>
        ) поля!
    </div>
<?php endif ?>

<?php if ($article->hasAuthor()): ?>
    <div>Автор статьи: <?= $article->getAuthor()->getName() ?></div>
    <div>Email автора: <?= $article->getAuthor()->getEmail() ?></div>
<?php else : ?>
    <div>У этой статьи нет автора</div>
<?php endif ?>
<form action="/admin/edit" method="post" class="form">
    <laber for="article-title">Название статьи:</laber>
    <input class="input-title" type="text" id="article-title" name="title" value="<?= $article->getTitle() ?>">
    <laber for="article-text">Текст статьи</laber>
    <textarea class="area-text" id="article-text" name="text"><?= $article->getText() ?></textarea>
    <input class="btn btn-submit" type="submit" name="submit" value="Сохранить изменения в статье">
    <input type="hidden" name="id" value="<?= $article->getId() ?>">
    <a class="a-return" href="/admin">Вернуться в панель администратора не сохраняя</a>
</form>

</body>
</html>
