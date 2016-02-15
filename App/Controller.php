<?php


namespace App;


class Controller
{
    protected $view;

    public function __construct()
    {
        $this->view = new View();
    }
    /**
     * @param string $action
     */
    public function action($action)
    {
        $methodName = 'action' . ucfirst($action);
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
        header('Location: '.$uri);
        exit();
    }

    public function action404()
    {
        header("HTTP/1.0 404 Not Found");
        $this->view->display(__DIR__.'/templates/404.php');
        exit();
    }
}