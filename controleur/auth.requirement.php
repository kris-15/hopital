<?php
session_start();
if(isset($_SESSION['admin'])){
    header('location: index.admin.php');
}
require '../modele/Authentification.php';
$auth = new Authentification();
?>