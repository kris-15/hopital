<?php
    session_start();
    if(isset($_SESSION['receptionniste'])){
        $salutation = $_SESSION['receptionniste'];
    }else{
        header('Location: connexion.controleur.php');
    }
    require_once '../modele/Modele.php';
    require_once '../modele/Receptionniste.php';
    $titre = "Receptionniste";
    
    $receptionniste = new Receptionniste();
    
    //Pour récupérer les informations de la patiente à modifier
    if(isset($_GET['modifie'])){
        $id = (int) $_GET['modifie'];
        $patienteId = $receptionniste->get_id_by('id', 'patientes',$id);
        if(!$patienteId){
            $stop = "Identifiant inexistant";
        }else{
            $patiente = $receptionniste->find_patiente($patienteId);
            $adresse = $receptionniste->adresse_patiente($patienteId);
            $modifie = true;
            $lead = "Modification info patiente";
        }
    }

    //Pour supprimer une patiente enregistrée
    if(isset($_GET['supprimer'])){
        $id = $_GET['supprimer'];
        $supprimer = $receptionniste->supprimer_patiente($id);
        var_dump($supprimer);   
    }

    //Partie enregistrement de la patiente
    if(isset($_POST['enregistrer'])){
        extract($_POST);
        do{
            $code = strtoupper(substr(uniqid(), 7));
        }while($receptionniste->verifier_code($code) > 0);
        $enregistrer = $receptionniste->ajouter_patiente(
            [$nomDame, $prenomDame, $telephone, $code, $dateNais, $monsieur], 
            [$avenue,$numero, $quartier, $commune]
        );
        if($enregistrer){
            $satisfait = "Patient ajouter avec succès";
            unset($_POST);
        }else{
            $erreur = "Echec d'enregistrement du patient";
        }
    }
    //Partie modification des informations de la patiente
    if(isset($_POST['modifier'])){
        extract($_POST);
        $modifier = $receptionniste->modifier_patiente(
            [$nomDame, $prenomDame, $telephone, $dateNais, $monsieur, $_GET['modifie']], 
            [$avenue,$numero, $quartier, $commune, $_GET['modifie']]
        );
        if($modifier){
            $satisfait = "Information modifier avec succès";
            unset($_POST);
        }else{
            $erreur = "Echec de modification";
        }
    }
    $patientes = $receptionniste->get_patientes();

    //Partie recherche
    if(isset($_POST['recherche'])){
        extract($_POST);
        $patientes = $receptionniste->get_patientes_by_nom($nom);
    }

    //Pour afficher le formulaire d'ajout
    if(isset($_GET['ajouter']) AND $_GET['ajouter'] == "oui"){
        $ajouter = true;
    }
    require_once '../vue/index.receptionniste.vue.php';
?>