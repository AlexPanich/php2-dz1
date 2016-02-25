<?php


namespace App;


use App\Exception\Error404;

class Controller
{
    protected $view;

    public function __construct()
    {
        $this->view = new View();
    }

    /**
     * @param string $action
     * @return
     * @throws Error404
     */
    public function action($action)
    {
        $methodName = 'action' . ucfirst($action);
        if (!method_exists($this, $methodName)) {
            throw new Error404('Ошибка 404: Запрошен не верный метод');
        }
        return $this->$methodName();
    }

    protected function isPost()
    {
        return $_SERVER['REQUEST_METHOD'] == 'POST';
    }

    protected function isGet()
    {
        return $_SERVER['REQUEST_METHOD'] == 'GET';
    }

    protected function redirect($uri)
    {
        header('Location: ' . $uri);
        exit();
    }
}