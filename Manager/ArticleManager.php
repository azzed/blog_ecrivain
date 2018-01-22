<?php
/**
 * Created by PhpStorm.
 * User: utilisateur
 * Date: 10/12/2017
 * Time: 11:40
 */
require 'Connexion.php';
require __DIR__.'/../Entity/Article.php';


class ArticleManager
{



    public function __construct()
    {
        $this->connexion = new Connexion();
    }
    /* Afficher tout les articles */
    public function findAll()
        {
            $posts = [];
            $req = $this->connexion->connect()->prepare('SELECT id, title, content,  DATE_FORMAT(dateposts, \' % d /%m /%Y à % Hh % imin % ss\') AS creation_date_fr FROM posts ORDER BY dateposts DESC LIMIT 0, 5');
            $req->execute();
            $datas = $req->fetchAll();
            foreach ($datas as $data)
            {
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



}