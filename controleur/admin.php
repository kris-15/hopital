<?php
    session_start();
    require '../modele/Admin.php';
    if($_SESSION['admin'] == null){
        header('Location:connexion.controleur.php');
    }
    $admin = new Admin($_SESSION['admin'], "");
    $medecins = $admin->recuperer_info('medecins');
    $receptionnistes = $admin->recuperer_info('receptionnistes');
    $certificats = $admin->recuperer_info('certificats');
    $patientes = $admin->recuperer_info('patientes');
    $accouchements = $admin->recuperer_info('accouchements');
    $enfants = $admin->recuperer_info('enfants');

    require "../vue/admin.vue.php";
?>