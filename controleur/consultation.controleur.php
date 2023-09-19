<?php
require '../controleur/medecin.requirement.php';
$medecinId = $medecin->get_id_by("username","medecins", $salutation);
$patiente;

if(isset($_GET['patiente'])){
    $patienteId = $medecin->get_id_by('id', 'patientes',$_GET['patiente']);
    if(!$patienteId){
        $stop = "Identifiant inexistant";
    }else{
        $patiente = $medecin->find_patiente($patienteId);
    }
}else{
    $stop = "Veuillez chercher la patiente concernée";
}

//Pour enregistrer une nouvelle consultation
if(isset($_POST['enregistrer'])){
    extract($_POST);
    $accouchement = $medecin->enregistrer_consultation([$patiente->id,$medecinId,$poids,$temperature,$tension,$observation]);
    var_dump($accouchement);
    
}
$consultations = $medecin->consultation_patiente($patiente->id);
require "../vue/consultation.vue.php";