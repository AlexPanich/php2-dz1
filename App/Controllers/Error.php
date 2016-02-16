<?php


namespace App\Controllers;


use App\Controller;

class Error extends Controller
{
    public function actionError404()
    {
        header("HTTP/1.0 404 Not Found");
        $this->view->display(__DIR__.'/../../templates/404.php');
    }

    public function actionDBError()
    {
        $this->view->display(__DIR__.'/../../templates/DBError.php');
    }
}