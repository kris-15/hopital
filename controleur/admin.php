<?php
    session_start();
    require '../modele/Admin.php';
    require '../modele/Consultation.php';
    require_once 'twilio.config.php';
    if($_SESSION['admin'] == null){
        header('Location:connexion.controleur.php');
    }
    $cpt = 1;
    $admin = new Admin($_SESSION['admin'], "");
    $tel = "+243";

    if(isset($_GET['detail'])){
        switch($_GET['detail']){
            case "medecin":
                $detailMedecin = true;break;
            case "receptionniste":
                $rec = true;break;
            case "consultation":
                $detailConsultation=true;break;
            case "accouchement":
                $detailAccouchement = true;break;
            case "patiente":
                $detailPatientes = true;break;
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
            if( str_starts_with($telephone, "0")){
                $telephone = substr($telephone, 1);
            }
            $tel .= $telephone;
            $code = "RE".strtoupper(substr(uniqid(),9));
            $insertion = $admin->ajouter_receptionniste($nom,$prenom,$tel,$code);
            if($insertion){
                try{
                    $message = "Vous avez été ajouté comme receptionniste de l'hopita. Utilisez votre numéro et ce code : '$code' pour vous connecter \n http://192.168.229.101/hopital/controleur/connexion.controleur.php";
                    send_sms($tel, $message);
                }catch(Exception $e){
                    echo 'Probleme de connexion';
                }
                $satisfait = "Nouveau receptionniste créé avec succès";unset($_POST);
            }
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
    $nombrePatientes = $admin->recuperer_info('patientes');
    $accouchements = $admin->recuperer_info('accouchements');
    $nombreEnfants = $admin->recuperer_info('enfants');
    $consultation = $admin->recuperer_info("consultations");
    $consultations = $admin->liste_consultations();
    $enfants = $admin->liste_enfants();
    $patientes = $admin->get_patientes();

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