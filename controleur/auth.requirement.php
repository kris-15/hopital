<?php
session_start();
if(isset($_SESSION['medecin'])){
    header('location: index.admin.php');
}
require '../modele/Authentification.php';
$auth = new Authentification();
?>