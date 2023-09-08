<?php 
    require_once 'auth.requirement.php';
    $admin = $auth->check_admin_by_username($_SESSION['activation']);
    if($admin['statut_compte'] == "ACTIVE"){
        $_SESSION['admin'] = $admin['username'];
        header('Location: index.admin.php');
    }
    if(isset($_SESSION['activation'])){

    }else{
        header('location: connexion.controleur.php');
    }
    if(isset($_POST['activation'])){
        extract($_POST);
        $active = $auth->activer_compte($_SESSION['activation'], $code);
        if($active){
            $_SESSION['admin'] = $admin['username'];
            header('Location: index.admin.php');
        }else{
            $erreur = "Code d'activation invalide";
        }
    }
    require_once '../vue/active.vue.php';