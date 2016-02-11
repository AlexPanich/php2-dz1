<?php


namespace App\Controllers;


use App\Controller;

class Admin extends Controller
{
    public function actionIndex()
    {
        $this->view->news = \App\Models\Article::findAll();

        $this->view->display(__DIR__.'/../../templates/admin.php');

    }

    public function actionNew()
    {
        if ( $this->isPost() ) {
            $article = new \App\Models\Article();
            $title = htmlspecialchars(trim(strip_tags($_POST['title'])));
            $text = htmlspecialchars(trim(strip_tags($_POST['text'])));

            $article->setTitle($title)->setText($text);

            if ( $article->save() ) {
                header('Location: /admin');
                exit();
            }

            $this->view->article = $article;
            $this->view->error = \App\Error::instance();
        } else {
            $this->view->error = false;
        }

        $this->view->display(__DIR__.'/../../templates/new.php');
    }

    public function actionEdit()
    {
        if ( $this->isPost() ) {
            $id = (int)$_POST['id'];
            $title = htmlspecialchars(trim(strip_tags($_POST['title'])));
            $text = htmlspecialchars(trim(strip_tags($_POST['text'])));
            $article = \App\Models\Article::findById($id);
            $article->setTitle($title)->setText($text);

            if ( $article->save() ) {
                header('Location: /admin');
                exit();
            } else {
                $view = new \App\View();
                $view->article = $article;
                $view->error = \App\Error::instance();
            }
        } else {

            if (!isset($_GET['id'])) {
                header('Location: /admin');
                exit();
            }

            $view = new \App\View();
            $view->error = false;
            $id = (int)$_GET['id'];
            $view->article = \App\Models\Article::findById($id);
        }
        $view->display(__DIR__.'/../../templates/edit.php');
    }

    public function actionDelete()
    {
        if ( !isset($_GET['id']) ) {
            header('Location: /admin');
            exit();
        }

        $id = (int)$_GET['id'];
        $article = \App\Models\Article::findById($id);
        $article->delete();

        header('Location: /admin');
    }
}