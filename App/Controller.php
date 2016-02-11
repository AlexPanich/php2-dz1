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
}