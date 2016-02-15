<?php


namespace App\Controllers;


use App\Controller;
use App\MultiException;

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
            $article->fill($_POST);

            try {
                $article->save();
                $this->redirect('/admin');
            } catch (MultiException $error) {
                $this->view->article = $article;
                $this->view->error = $error;
            }
        } else {
            $this->view->error = false;
        }

        $this->view->display(__DIR__.'/../../templates/new.php');
    }

    public function actionEdit()
    {
        if ( $this->isPost() ) {
            $article = \App\Models\Article::findById($_POST['id']);
            $article->fill($_POST);

            try {
                $article->save();
                $this->redirect('/admin');
            } catch (MultiException $error) {
                $this->view->article = $article;
                $this->view->error = $error;
            }

        } else {
            if (!isset($_GET['id'])) {
                $this->redirect('/admin');
            }
            $this->view->error = false;
            $this->view->article = \App\Models\Article::findById($_GET['id']);
        }
        $this->view->display(__DIR__.'/../../templates/edit.php');
    }

    public function actionDelete()
    {
        if ( !isset($_GET['id']) ) {
            $this->redirect('/admin');
        }

        $article = \App\Models\Article::findById($_GET['id']);
        $article->delete();

        $this->redirect('/admin');
    }

}