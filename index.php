<?php
session_start();
define('ROOT', __DIR__);
require 'Controller/Controller.php';
require 'Controller/AdminController.php';

$controller = new Controller();
$adminController = new AdminController();
if (empty($_SERVER['QUERY_STRING'])) {
    $controller->home();
} elseif (isset($_GET['article']) && !isset($_GET['action'])) {
    if (isset($_POST['commentaire']) && !empty($_POST['commentaire']) && isset($_POST['author']) && !empty($_POST['author'])) {
        //enregistrer le commentaire
        $controller->addComment($_GET['article'], $_POST['commentaire'], $_POST['author']);
    }
    //signale un commentaire
    if (isset($_POST['signale'])) {
        $controller->signalComment($_POST['signale']);
    }
    $controller->showArticle($_GET['article']);
}
//administration
elseif ((isset($_GET['action']) && $_GET['action'] == 'connexion')) {
    //la session en cours
    if (isset($_SESSION['pseudo'])) {

        //supprission d'article ou de commentaire selectionner
        if (isset($_POST['delete'])) {
            $adminController->removeComment($_POST['delete']);
        } elseif (isset($_POST['delete_article'])) {
            $adminController->removePost($_POST['delete_article']);
            $adminController->removeComment($_POST['delete_article']);
        }
        //ajout d'articles
        elseif (isset($_POST['title']) && !empty($_POST['title']) && isset($_POST['content']) && !empty($_POST['content'])) {
            if (isset($_POST['add'])) {
                $adminController->addPost($_POST['title'], $_POST['content']);
            }
        }
        //selectionner  l'article a modifier

        elseif (isset($_GET['edit']) && $_GET['edit'] == 'action' && isset($_GET['article'])) {
            if (isset($_POST['update'])) {
                $adminController->updatePost($_POST['edit_title'], $_POST['edit_content'], $_GET['article']);
                header('location:index.php?action=connexion');
            }
            $adminController->findPost($_GET['article']);

            return true;
        }
        $adminController->showDashboard();

        return true;
    } elseif (isset($_POST['pseudo']) && !empty($_POST['pseudo']) && isset($_POST['password']) && !empty($_POST['password'])) {
        $userExist = $adminController->verifUser($_POST['pseudo'], $_POST['password']);
        if ($userExist) {
            $adminController->showDashboard();

            return true;
        }
        $adminController->login();

        return false;
    }

    $adminController->login();
}
//deconnexion
elseif (isset($_GET['action']) && $_GET['action'] == 'deconnexion') {
    $adminController->logout();
    session_destroy();
}


