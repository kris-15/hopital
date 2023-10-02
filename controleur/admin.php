<?php
    session_start();
    require '../modele/Admin.php';
    if($_SESSION['admin'] == null){
        header('Location:connexion.controleur.php');
    }
    $cpt = 1;
    $admin = new Admin($_SESSION['admin'], "");
    $medecins = $admin->recuperer_info('medecins');
    $receptionnistes = $admin->recuperer_info('receptionnistes');
    $certificats = $admin->recuperer_info('certificats');
    $patientes = $admin->recuperer_info('patientes');
    $accouchements = $admin->recuperer_info('accouchements');
    $enfants = $admin->recuperer_info('enfants');

    if(isset($_GET['detail'])){
        switch($_GET['detail']){
            case "medecin":
                $detailMedecin = true;break;
        }
    }

    //Partie barre de recherche pour medecins
    if(isset($_POST['recherche_medecin'])){
        extract($_POST);
        $medecins = $admin->recherche_info("medecins","nom",$nom);
    }

    require "../vue/admin.vue.php";
?>