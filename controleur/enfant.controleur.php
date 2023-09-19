<?php
require '../controleur/medecin.requirement.php';
$medecinId = $medecin->get_id_by("username","medecins", $salutation);

if(isset($_GET['maman'])){
    $patienteId = $medecin->get_id_by('id', 'patientes',$_GET['maman']);
    if(!$patienteId){
        $stop = "Identifiant inexistant";
    }
    $patiente = $medecin->find_patiente($patienteId);
}else{
    $stop = "Veuillez chercher la femme concernée";
}

if(isset($_POST['enregistrer'])){
    extract($_POST);
    $enfantExist = $medecin->check_enfants(
        [$nom,$sexe,$poids,$dateNais,$taille,$apgar,$pc,$observation_enfant,$patienteId,$medecinId,$etat]
    );
    if($enfantExist == 0){
        $enregistrerEnfant = $medecin->enregistrer_enfant(
            [$nom,$sexe,$poids,$dateNais,$taille,$apgar,$pc,$observation_enfant,$patienteId,$medecinId,$etat]
        );
        var_dump($enregistrerEnfant);
        $enregistrerAccouchement = $medecin->enregistrer_accouchement(
            [$patienteId,$medecinId,$observation_maman,$dateNais,$voie,$type,$vih, $enregistrerEnfant['id']]
        );
        $satisfait = "Enregistrement avec succès";
        unset($_POST);
    }else{
        $erreur = "Cet enfant existe déjà";
    }
    
}
require "../vue/ajouter.enfant.vue.php";