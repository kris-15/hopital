<?php
    require '../controleur/medecin.requirement.php';
    require '../modele/Consultation.php';

    //Partie enregistrement de la patiente
    if(isset($_POST['enregistrer'])){
        extract($_POST);
        do{
            $code = strtoupper(substr(uniqid(), 7));
        }while($medecin->verifier_code($code) > 0);
        $enregistrer = $medecin->ajouter_patiente(
            [$nomDame, $prenomDame, $telephone, $code, $dateNais, $monsieur], 
            [$avenue,$numero, $quartier, $commune]
        );
        if($enregistrer){
            $satisfait = "Patient ajouter avec succès";
            unset($_POST);
        }else{
            $erreur = "Echec d'enregistrement du patient";
        }
    }
    $patientes = $medecin->get_patientes();
    if(isset($_GET['detail']) AND $_GET['detail'] == "consultation"){
        $voirConsultation = true;
    }
    if(isset($_GET['detail']) AND $_GET['detail'] == "enfants"){
        $voirEnfants = true;
    }
    //Partie recherche
    if(isset($_POST['recherche'])){
        extract($_POST);
        $patientes = $medecin->get_patientes_by_nom($nom);
    }
    $consultations = $medecin->consultations();
    $enfants = $medecin->liste_enfants();
    require_once '../vue/index.admin.vue.php';
?>