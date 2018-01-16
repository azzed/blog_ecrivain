<?php
/**
 * Created by PhpStorm.
 * User: azzedine
 * Date: 10/12/2017
 * Time: 11:37
 */
require __DIR__.'/../Manager/ArticleManager.php';
require __DIR__."/../Manager/CommentManager.php";
class Controller
{
    protected $manager;
    protected $commentManager;


    public function __construct()
    {
        $this->manager = new ArticleManager();
        $this->commentManager = new CommentManager();
    }


    public function home()
    {


        $articles = $this->manager->findAll();

        include ROOT."/view/home.phtml";
    }

    public function showArticle($id)
    {

        $article = $this->manager->findOne($id);
        include ROOT."/view/article.phtml";
    }
    public function addComment($id,$comment)
    {
        $this->commentManager->addComment($id,$comment);
    }
}