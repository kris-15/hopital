<?php 
    require_once 'auth.requirement.php';
    $medecin = $auth->check_medecin_by_username($_SESSION['activation']);
    if($medecin['statut_compte'] == "ACTIVE"){
        $_SESSION['medecin'] = $medecin['username'];
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