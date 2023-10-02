<?php 
    require_once 'auth.requirement.php';
    if(isset($_POST['connexion'])){
        extract($_POST);
        $medecin = $auth->connexion_medecin($username, $motDePasse);
        if($medecin){
            switch($medecin['statut_compte']){
                case "EN ATTENTE":
                    $_SESSION['activation'] = $medecin['username'];
                    header('Location: active.controleur.php');
                    break;
                case "DESACTIVE":
                    $erreur = "Compte supprimé ou bloqué";
                    break;
                case "ACTIVE":
                    $_SESSION['medecin'] = $medecin['username'];
                    header('Location: index.admin.php');
                    break;
            }
        }else{
            $erreur = "Adresse email ou mot de passe incorrect";
        }
         
    }

    require_once '../vue/connexion.vue.php'
?>