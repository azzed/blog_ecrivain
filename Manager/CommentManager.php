<?php
/**
 * Created by PhpStorm.
 * User: utilisateur
 * Date: 11/01/2018
 * Time: 12:08.
 */
require_once 'Connexion.php';
require_once __DIR__ . '/../Entity/Article.php';
require_once __DIR__ . '/../Entity/Commentaire.php';

class CommentManager
{
    public function __construct()
    {
        $this->connexion = new Connexion();
    }

    //fonction ajout de commentaire
    public function addComment($postId, $comment, $author)
    {
        $req = $this->connexion->connect()->prepare('INSERT INTO comment(post_id, comment,author, dateComent) VALUES(:post_id, :comment,:author, NOW())');
        $req->bindValue(':post_id', $postId);
        $req->bindValue(':comment', $comment);
        $req->bindValue(':author', $author);
        $affectedLines = $req->execute();

        return $affectedLines;
    }

    //fonction rechercher les commentaire par id
    public function findCommentById($postId)
    {
        $post_comment = [];
        $req = $this->connexion->connect()->query('SELECT * FROM comment WHERE post_id = ' . $postId);
        $comments = $req->fetchAll();
        foreach ($comments as $commentaire) {
            $post_comment[] = new Commentaire($commentaire);
        }

        return $post_comment;
    }

    //fonction signaler commentaire
    public function commentReported($commentId)
    {
        $signaler = $this->connexion->connect()->query('UPDATE comment SET signale = TRUE WHERE id = ' . $commentId);
        $signaler->execute();
    }

    //fonction rechercher le commentaire signale
    public function findCommentSignaler()
    {
        $post_reported = [];
        $req = $this->connexion->connect()->query('SELECT * FROM comment WHERE signale = 1 ');
        $commentSignale = $req->fetchAll();
        foreach ($commentSignale as $signale) {
            $post_reported[] = new Commentaire($signale);
        }

        return $post_reported;
    }

    //effacer  commentaire signales
    public function deleteComment($ids)
    {
        $in = str_repeat('?,', count($ids) - 1) . '?';
        $sql = "DELETE  FROM comment WHERE id IN ($in)";
        $req = $this->connexion->connect()->prepare($sql);
        $req->execute($ids);
    }
}
