<?php
    define('ROOT',__DIR__);
    require 'Controller/Controller.php';
    $controller = new Controller();
    if(empty($_SERVER["QUERY_STRING"]))
    {
        $controller -> home();
    }
    else if(isset($_GET['article']))
    {
        if(isset($_POST) && !empty($_POST))
        {
           //enregistrer le commentaire
            $controller->addComment($_GET['article'],$_POST);
        }
        $controller->showArticle($_GET['article']);

    }
    else if((isset($_GET['admin']) == 'connexion') && !empty($_POST))
    {
        var_dump($_POST);
    }

