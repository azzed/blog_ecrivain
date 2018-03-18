<?php
/**
 * Created by PhpStorm.
 * User: utilisateur
 * Date: 06/02/2018
 * Time: 16:16.
 */
require_once __DIR__.'/../Entity/Article.php';
require_once __DIR__.'/../Entity/Commentaire.php';
require_once 'Connexion.php';
class AdminManager
{
    public function __construct()
    {
        $this->connexion = new Connexion();
    }

    //chercher les identifiant de l'admin
    public function findUser($pseudo, $password)
    {
        $encrypt = sha1($password);
        $req = $this->connexion->connect()->prepare('SELECT * FROM admin  WHERE pseudo = :pseudo AND password = :password ');
        $req->execute(array(':pseudo' => $pseudo, ':password' => $encrypt));
        $users = $req->fetch();
        return $users;
    }
}