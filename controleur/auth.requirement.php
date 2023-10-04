<?php
session_start();
if(isset($_SESSION['medecin'])){
    header('location: index.admin.php');
}
require '../modele/Authentification.php';
require '../modele/Receptionniste.php';
$auth = new Authentification();
?>