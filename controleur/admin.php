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
            case "receptionniste":
                $rec = true;break;
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
        if(isset($_GET['action'])){
            if($_GET['action']=="ajouter")$ajouter = true;
            if($_GET['action']=="modifier" AND isset($_GET['id'])){
                $idRec = (int) $_GET['id'];
                $receptionniste = $admin->recuperer_par_id("receptionnistes", $idRec);
                if($receptionniste)$modifier=true;
                else $erreur = "Identifiant incorrect";
            }
            if($_GET['action']=="supprimer" AND isset($_GET['id'])){
                $idRec = (int) $_GET['id'];
                $receptionniste = $admin->recuperer_par_id("receptionnistes", $idRec);
                if($receptionniste){
                    $supression = $admin->supprimer_par_id("receptionnistes", $receptionniste->id);
                    if($supression)$succes="Receptionniste supprimé avec succès";
                    else $erreur = "Echec de suppression";
                }
                else $erreur = "Identifiant incorrect";
            }
        }
        if(isset($_POST['enregistrer'])){
            extract($_POST);
            $code = "RE".strtoupper(substr(uniqid(),9));
            $insertion = $admin->ajouter_receptionniste($nom,$prenom,$telephone,$code);
            if($insertion){$satisfait = "Nouveau receptionniste créé avec succès";unset($_POST);}
            else $erreurForm = "Echec d'enregistrement";
        }
        if(isset($_POST['modifier'])){
            extract($_POST);
            $insertion = $admin->modifier_info_receptionniste($receptionniste->id,$nom,$prenom,$telephone);
            if($insertion){$satisfait = "Mise à jour avec succès";unset($_POST);$receptionniste = $admin->recuperer_par_id("receptionnistes", $receptionniste->id);}
            else $erreurForm = "Echec de modification";
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