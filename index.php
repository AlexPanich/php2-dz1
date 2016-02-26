<?php

use App\Logger;

require_once __DIR__ . '/autoload.php';

$uri = explode('/', $_SERVER['REQUEST_URI']);

$params = [];

foreach ($uri as $value) {
    if ($value != '') {
        $params[] = $value;
    }
}

if (empty($params[0])) {
    $params[0] = 'article';
}

$action = isset($params[1]) ? $params[1] : 'index';

switch ($params[0]) {
    case 'article':
        $controller = new \App\Controllers\Article();
        break;
    case 'admin':
        $controller = new \App\Controllers\Admin();
        break;
    default:
        $controller = new \App\Controllers\Error();
        $action = 'error404';
        Logger::instance()->save('Ошибка 404: Введен не существующий адресс');
}

try {
    $controller->action($action);
    exit();
} catch (\App\Exception\DB $e) {
    $action = 'DBError';
    \App\Mailer::instance()->send('Ошибка подключения к БД' . $e->getCode());
} catch (\App\Exception\Error404 $e) {
    $action = 'error404';
} finally {
    $controller = new \App\Controllers\Error();
    $controller->action($action);
    Logger::instance()->save($e->getMessage());
}