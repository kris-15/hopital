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
    $enregistrement = $medecin->enregistrer_enfant([$nom,$sexe,$poids,$dateNais,$patienteId,$medecinId,$etat]);
}
require "../vue/ajouter.enfant.vue.php";