<?php
/**
 * Created by PhpStorm.
 * User: utilisateur
 * Date: 30/01/2018
 * Time: 09:53
 */
require_once __DIR__.'/../Manager/AdminManager.php';
require_once __DIR__.'/../Manager/CommentManager.php';
require_once __DIR__.'/../Manager/ArticleManager.php';

class AdminController
{

    protected  $adminManager;
    protected $commentManager;
    protected $articleManager;

    public function __construct()
    {
        $this->adminManager = new AdminManager();
        $this->commentManager = new CommentManager();
        $this->articleManager = new ArticleManager();

    }

    public function showDashboard()
    {
        $articles = $this->articleManager->findAll();
        $commentsignaler = $this->commentManager->findCommentSignaler();
        include ROOT."/view/dashboard.phtml";

    }
    public function login()
    {

        include ROOT."/view/connexion.phtml";
    }
    //verification de l'utilisateur
    public function verifUser($admin,$mdp)
    {
        $user = $this->adminManager->findUser($admin,$mdp);

        if($user)
        {
            $_SESSION['pseudo'] = $user;
            return true;
        }
        return false;
    }
    //deconnexion de la session
    public function logout()
    {
        unset($_SESSION['pseudo']);
        header("location: index.php?action=connexion");

    }
    //suppression de commentaire
    public function removeComment($ids)
    {
        $this->commentManager->deleteComment($ids);
    }
    //ajout d'article
    public function addPost($title,$content)
    {
        $this->articleManager->addPosts($title,$content);
    }
    //suppression d'article
    public function removePost($ids)
    {
        $this->articleManager->removePost($ids);
        $this->commentManager->deleteComment($ids);
    }
    //selection d'un article a modifier
    public function findPost($id)
    {
        $article = $this->articleManager->findOne($id);
        include ROOT."/view/articleModifier.phtml";
    }
    //modifiaction de l'article
    public function  updatePost($title,$content,$id)
    {

        $article = $this->articleManager->updatePost($title,$content,$id);
        include ROOT."/view/articleModifier.phtml";
    }

}