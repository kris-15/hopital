<?php 
    require_once 'auth.requirement.php';
    if(isset($_POST['connexion'])){
        extract($_POST);
        $admin = $auth->connexion_admin($username, $motDePasse);
        if($admin){
            switch($admin['statut_compte']){
                case "EN ATTENTE":
                    $_SESSION['activation'] = $admin['username'];
                    header('Location: active.controleur.php');
                    break;
                case "DESACTIVE":
                    $erreur = "Compte supprimé ou bloqué";
                    break;
                case "ACTIVE":
                    $_SESSION['admin'] = $admin['username'];
                    header('Location: index.admin.php');
                    break;
            }
        }else{
            $erreur = "Adresse email ou mot de passe incorrect";
        }
         
    }

    require_once '../vue/connexion.vue.php'
?>