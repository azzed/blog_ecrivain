<?php
/**
 * Created by PhpStorm.
 * User: utilisateur
 * Date: 10/12/2017
 * Time: 11:40
 */
require 'Connexion.php';
require __DIR__ . '/../Entity/Article.php';


class ArticleManager
{


    public function __construct()
    {
        $this->connexion = new Connexion();
        $this->commentManager = new CommentManager();
    }

    /* Afficher tout les articles */
    public function findAll()
    {
        $posts = [];
        $req = $this->connexion->connect()->prepare('SELECT id, title, content,  DATE_FORMAT(dateposts, \' % d /%m /%Y à % Hh % imin % ss\') AS creation_date_fr FROM posts ORDER BY dateposts DESC LIMIT 0, 5');
        $req->execute();
        $datas = $req->fetchAll();
        foreach ($datas as $data) {
            $posts[] = new Article($data);
        }
        return $posts;

    }

    /* Afficher un seul article*/
    public function findOne($postId)
    {
        $req = $this->connexion->connect()->prepare('SELECT id, title, content,  DATE_FORMAT(dateposts, \' % d /%m /%Y à % Hh % imin % ss\') AS date_creation_fr FROM posts WHERE id = ?');
        $req->execute(array($postId));
        $data = $req->fetch();
        $post = new Article($data);

        return $post;
    }

    //ajouter un article
    public function addPosts($title, $content)
    {
        $req = $this->connexion->connect()->prepare('INSERT INTO posts(id, title,content, dateposts) VALUES(id, :title,:content, NOW()) ');
        $req->bindValue(':title', $title);
        $req->bindValue(':content', $content);
        $addPost = $req->execute();
    }

    //suppression d'article
    public function removePost($ids)
    {
        $in = str_repeat('?,', count($ids) - 1) . '?';
        $sql = "DELETE  FROM posts WHERE id IN ($in)";
        $req = $this->connexion->connect()->prepare($sql);
        $req->execute($ids);
        $this->commentManager->deleteComment($ids);


    }


    //modification d'article
    public function updatePost($title, $content, $postId)
    {
        $req = $this->connexion->connect()->prepare('UPDATE posts SET title =:title, content=:content WHERE id =:id');
        $req->bindValue(':title', $title);
        $req->bindValue(':content', $content);
        $req->bindValue(':id', $postId);
        $req->execute();

        $post = new Article(['title' => $title, 'content' => $content, 'id' => $postId]);

        return $post;


    }


}