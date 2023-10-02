<?php
session_start();
require_once '../modele/Medecin.php';
$titre = "Administrateur";
if(isset($_SESSION['medecin'])){
    $salutation = $_SESSION['medecin'];
}else{
    header('Location: connexion.controleur.php');
}
$medecin = new Medecin();
?>