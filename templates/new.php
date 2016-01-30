<!doctype html>
<html lang="ru-RU">
<head>
    <meta charset="UTF-8">
    <title>Панель администратора - создание новой статьи</title>
    <link rel="stylesheet" href="/templates/css/style.css">
</head>
<body>
<h2 class="page-title">Панель администратора - создание новой статьи</h2>

<form action="new.php" method="post" class="form">
    <laber for="article-title">Название статьи:</laber>
    <input class="input-title" type="text" id="article-title" name="title">
    <laber for="article-text">Текст статьи</laber>
    <textarea class="area-text" id="article-text" name="text"></textarea>
    <input class="btn btn-submit" type="submit" name="submit" value="Создать статью">
    <a class="a-return" href="admin.php">Вернуться в панель администратора не сохраняя</a>
</form>

</body>
</html>

