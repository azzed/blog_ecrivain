<?php

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
    //fonction affichage par article
    public function showArticle($id)
    {
        $article = $this->manager->findOne($id);
        $comments = $this->commentManager->findCommentById($id);
        $signale = $this->commentManager->commentReported($id);
        include ROOT."/view/article.phtml";
    }
    public function addComment($id,$comment,$author)
    {
        $this->commentManager->addComment($id,$comment,$author);
    }
    public function  signalComment($commentId)
    {
        $this->commentManager->commentReported($commentId);
    }
}