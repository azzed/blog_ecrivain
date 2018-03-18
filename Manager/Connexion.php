<?php
/**
 * Created by PhpStorm.
 * User: azzedine
 * Date: 31/12/2017
 * Time: 11:32.
 */
class Connexion
{
    //connexion à la base de donnée
    public function connect()
    {
        $db = new PDO('mysql:host=localhost;dbname=blog_ecrivain;charset=utf8', 'root', '');

        return $db;
    }
}
