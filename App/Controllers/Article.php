<?php


namespace App\Controllers;


use App\Controller;
use App\Exception\Error404;

class Article extends Controller
{

    protected function actionIndex()
    {
        $this->view->news = \App\Models\Article::findLastN(3);
        $this->view->display(__DIR__.'/../../templates/index.php');
    }

    protected function actionOne()
    {
        if ( !$this->view->article = \App\Models\Article::findById($_GET['id']) ) {
            throw new Error404('Ошибка 404: нет записи с id='. $_GET['id']);
        }

        $this->view->display(__DIR__.'/../../templates/article.php');
    }
}