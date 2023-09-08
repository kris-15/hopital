<?php
    session_start();
    $titre = "Administrateur";
    if(isset($_SESSION['admin'])){
        $salutation = $_SESSION['admin'];
    }else{
        header('Location: connexion.controleur.php');
    }
    require_once '../vue/index.admin.vue.php';
?>