<?php
/**
 * Created by PhpStorm.
 * User: utilisateur
 * Date: 11/01/2018
 * Time: 12:08
 */
require 'Connexion.php';
require __DIR__.'/../Entity/Article.php';
class CommentManager
{
    public function __construct()
    {
        $this->connexion = new Connexion();
    }
    public function addComment($postId,$comment,$author)
    {
        $comments = $this->connexion->prepare('INSERT INTO comment(post_id, author, comment, comment_date) VALUES(?, ?, ?, NOW())');
        $affectedLines = $comments->execute(array($postId, $author, $comment));
        return $affectedLines;
    }
}