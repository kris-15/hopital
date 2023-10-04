<?php
    session_start();
    require_once '../modele/Admin.php';
    require_once '../modele/Receptionniste.php';
    if(isset($_SESSION['admin']))$acteur = new Admin($_SESSION['admin'], '');
    elseif(isset($_SESSION['medecin']))$acteur = new Medecin();
    elseif(isset($_SESSION['receptionniste']))$acteur = new Receptionniste();
    else header('Location: ../controleur/connexion.controleur.php');
    if(isset($_GET['id_enfant'])){
        $idEnfant = $_GET['id_enfant'];
        $enfant = $acteur->affiche_certificat_enfant($idEnfant);
        if(!$enfant){
            die("Identifiant incorrect");
        }

    }else{
        die("Aucun identifiant trouvé");
    }
?>
<!DOCTYPE html>
<html lang="en" onload="window.print()">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Certificat N°1</title>
    <link rel="canonical" href="https://getbootstrap.com/docs/5.3/examples/dashboard/">

    

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@docsearch/css@3">

<link href="../assets/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }

      .b-example-divider {
        width: 100%;
        height: 3rem;
        background-color: rgba(0, 0, 0, .1);
        border: solid rgba(0, 0, 0, .15);
        border-width: 1px 0;
        box-shadow: inset 0 .5em 1.5em rgba(0, 0, 0, .1), inset 0 .125em .5em rgba(0, 0, 0, .15);
      }

      .b-example-vr {
        flex-shrink: 0;
        width: 1.5rem;
        height: 100vh;
      }

      .bi {
        vertical-align: -.125em;
        fill: currentColor;
      }

      .nav-scroller {
        position: relative;
        z-index: 2;
        height: 2.75rem;
        overflow-y: hidden;
      }

      .nav-scroller .nav {
        display: flex;
        flex-wrap: nowrap;
        padding-bottom: 1rem;
        margin-top: -1px;
        overflow-x: auto;
        text-align: center;
        white-space: nowrap;
        -webkit-overflow-scrolling: touch;
      }

      .btn-bd-primary {
        --bd-violet-bg: #712cf9;
        --bd-violet-rgb: 112.520718, 44.062154, 249.437846;

        --bs-btn-font-weight: 600;
        --bs-btn-color: var(--bs-white);
        --bs-btn-bg: var(--bd-violet-bg);
        --bs-btn-border-color: var(--bd-violet-bg);
        --bs-btn-hover-color: var(--bs-white);
        --bs-btn-hover-bg: #6528e0;
        --bs-btn-hover-border-color: #6528e0;
        --bs-btn-focus-shadow-rgb: var(--bd-violet-rgb);
        --bs-btn-active-color: var(--bs-btn-hover-color);
        --bs-btn-active-bg: #5a23c8;
        --bs-btn-active-border-color: #5a23c8;
      }
      .bd-mode-toggle {
        z-index: 1500;
      }
    </style>

    
    <!-- Custom styles for this template -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="../layout/dashboard.css" rel="stylesheet">
</head>
<body class=" mx-3 mt-1">
    <div class="d-flex justify-content-end mb-1">
        <button type="submit" class="btn btn-sm btn-primary" onclick="window.print()">Print</button>
    </div>
    <div class=" mx-2">
        <div class="d-flex justify-content-between">
            <div class="">
                <p class="fs-6 text-primary text-center">
                    REPUBLIQUE DEMOCRATIQUE DU CONGO <br>
                    MINISTERE DE LA SANTE <br>
                    INSPECTION PROVINCIALE DE LA SANTE <br>
                    <img src="../image/drapeau-rd-congo.jpg" class="my-2" alt="" height="100" width="190"><br>
                    
                    HOPITAL DE L'AMITIE SINO-CONGOLAISE <br>
                    KINSHASA - NDJILI
                </p>
            </div>
            <div class="">
                <img src="../image/hopital.jpg" alt="" height="200" width="400" srcset="">
            </div>
        </div>
    </div>
    <h1 class="text-center text-primary m-1">CERTIFICAT DE NAISSANCE N° <?= $enfant->id_enfant ?></h1>
    <p class="mx-4 p-2 fs-5">
        Je soussigné Docteur  <?= strtoupper($enfant->nom_medecin) ?> <br>
        Certifie que la nommée <?= strtoupper($enfant->nom_maman)?> <br>
        a accouché à l'Hôpital de l'Amitié Sino-Congolaise (HASC) à Kinshasa Ndjili <br>
        d'un enfant du sexe <strong> <?= strtoupper($enfant->sexe) ?></strong> pesant <strong><?=$enfant->poids?></strong> grammes <br>
        avec un périmètre cranien de <strong><?=$enfant->pc?></strong> grammes <br>
        taille <strong><?=$enfant->taille?></strong> centimètres <br>
        En date du <strong><?=$enfant->date_formatee?></strong> <br>

    </p>
    <p class="text-end">Fait à Kinshasa, Le <strong><?= date('d / m / Y')?></strong></p>
    <div class="d-flex justify-content-between">
        <div class="">
            <p>Sceau de l'hopital</p>
        </div>
       <div class="">
            <p class="text-center">
                Nom et Signature du Médecin <br>
                <?= strtoupper($enfant->nom_medecin) ?>
            </p>
       </div>
    </div>
    
</body>
</html>