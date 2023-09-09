<?php
    session_start();
    $titre = "Administrateur";
    if(isset($_SESSION['admin'])){
        $salutation = $_SESSION['admin'];
    }else{
        header('Location: connexion.controleur.php');
    }
    if(isset($_POST['enregistrer'])){
        echo'<pre>';
        print_r($_POST);
        echo '</pre>';
    }
    require_once '../vue/index.admin.vue.php';
?>