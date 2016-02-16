<?php

require_once __DIR__.'/autoload.php';

$uri = explode('/', $_SERVER['REQUEST_URI']);

$params = [];

foreach ( $uri as $value ) {
    if ( $value != '') {
        $params[] = $value;
    }
}

if ( empty($params[0]) ) {
    $params[0] = 'article';
}

switch ( $params[0] ) {
    case 'article':
        $controller = new \App\Controllers\Article();
        break;
    case 'admin':
        $controller = new \App\Controllers\Admin();
        break;
    default:
        die('404');
}

$action = isset($params[1]) ? $params[1]: 'index';

try {
    $controller->action($action);
    exit();
} catch ( \App\Exception\DB $e ) {
    $action = 'DBError';
} catch ( \App\Exception\Error404 $e ) {
    $action = 'error404';
} finally {
    $controller = new \App\Controllers\Error();
    $controller->action($action);
    \App\Logger::instance()->save($e->getMessage());
}