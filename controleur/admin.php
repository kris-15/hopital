<?php
    session_start();
    require '../modele/Admin.php';
    if($_SESSION['admin'] == null){
        header('Location:connexion.controleur.php');
    }
    $cpt = 1;
    $admin = new Admin($_SESSION['admin'], "");

    if(isset($_GET['detail'])){
        switch($_GET['detail']){
            case "medecin":
                $detailMedecin = true;break;
        }
        if(isset($_GET['block'])){
            $id = (int) $_GET['block'];
            $medecin = modifier_statut_compte_medecin($id,"DESACTIVE", "ACTIVE");
            if($medecin)$okay="Vous avez desactivé le compte du médecin {$medecin->nom}";
            if($medecin == false)$erreur="Compte déjà bloqué";
            if($medecin == null)$erreur="Médecin inexistant";
        }
        if(isset($_GET['deblock'])){
            $id = (int) $_GET['deblock'];
            $medecin = modifier_statut_compte_medecin($id,"ACTIVE","DESACTIVE");
            if($medecin)$okay="Vous avez activé le compte du médecin {$medecin->nom}";
            if($medecin == false){$erreur="Compte déjà bloqué";}
            if($medecin == null){$erreur="Médecin inexistant";}
        }
    }
    $medecins = $admin->recuperer_info('medecins');
    $receptionnistes = $admin->recuperer_info('receptionnistes');
    $certificats = $admin->recuperer_info('certificats');
    $patientes = $admin->recuperer_info('patientes');
    $accouchements = $admin->recuperer_info('accouchements');
    $enfants = $admin->recuperer_info('enfants');

    //Partie barre de recherche pour medecins
    if(isset($_POST['recherche_medecin'])){
        extract($_POST);
        $medecins = $admin->recherche_info("medecins","nom",$nom);
    }

    function modifier_statut_compte_medecin($id, $statut, $avant){
        $admin = new Admin("", "");
        $medecin = $admin->recuperer_par_id("medecins",$id);
        
        if($medecin){
            if($medecin->statut_compte ==$statut){
                return false;
            }else{
                $block = $admin->modifier_statut_compte_medecin($statut, $medecin->id);
                if($block)return $medecin;
            }
        }else{
            return null;
        }
    }

    require "../vue/admin.vue.php";
?>