<?php


namespace App\Controllers;


use App\Controller;

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
            $this->action404();
        }

        $this->view->display(__DIR__.'/../../templates/article.php');
    }
}