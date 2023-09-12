<?php
session_start();
require_once '../modele/Medecin.php';
$titre = "Administrateur";
if(isset($_SESSION['admin'])){
    $salutation = $_SESSION['admin'];
}else{
    header('Location: connexion.controleur.php');
}
$medecin = new Medecin();
?>