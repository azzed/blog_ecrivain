<?php
/**
 * Created by PhpStorm.
 * User: utilisateur
 * Date: 11/01/2018
 * Time: 12:08
 */
require_once 'Connexion.php';
require_once __DIR__.'/../Entity/Article.php';
require_once __DIR__.'/../Entity/Commentaire.php';
class CommentManager
{

    public function __construct()
    {
        $this->connexion = new Connexion();
    }
    public function addComment($postId,$comment,$author='azz')
    {

        $req = $this->connexion->connect()->prepare('INSERT INTO comment(post_id, comment,author, dateComent) VALUES(:post_id, :comment,:author, NOW())');
        $req->bindValue(':author', $author);
        $req->bindValue(':post_id', $postId);
        $req->bindValue(':comment', $comment);
        $affectedLines = $req->execute();


        return $affectedLines;
    }
    public  function findCommentById($postId)
    {
        $post_comment = [];
        $req = $this->connexion->connect()->query('SELECT * FROM comment WHERE post_id = '.$postId);
        $comments = $req->fetchAll();
        foreach ($comments as $commentaire)
        {
            $post_comment[] = new Commentaire($commentaire);
        }
        return $post_comment;
    }
}