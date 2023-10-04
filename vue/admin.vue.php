<?php 
    
    $lead = "Admininistration ";
    if(isset($rec))$lead = "Info Réceptionniste";
    if(isset($ajouter))$lead = " Admin -Ajouter Réceptionniste";
    if(isset($detailConsultation))$lead = "Rapport des consultations";
    if(isset($detailAccouchement))$lead = "Rapport des enfants enregistrés";
    if(isset($detailMedecin))$lead = "Comptes des médecins";
    if(isset($detailPatientes))$lead = "Liste des patientes";
    $titre = "Administrateur";
    ob_start();
?>

<div class="container">
    <div class="d-flex justify-content-end">
        <a href="" class="btn btn-sm btn-primary" onclick="window.print()">Imprimer</a>
    </div>
    <?php 
        if(isset($detailMedecin)){
            require_once 'admin_liste_medecin.php';
        }elseif(isset($rec)){
            require_once 'admin_ajoute_rec.vue.php'; 
        }elseif(isset($detailConsultation)){
            require_once 'admin_consultation.vue.php';
        }elseif(isset($detailAccouchement)){
            require_once 'admin_accouchement.vue.php';
        }elseif(isset($detailPatientes)){
            require_once 'admin_liste_patiente.vue.php';
        }else{ 
    ?>
    <div class="row align-items-md-stretch">
        <div class="col-md-6 mt-2">
            <div class="h-100 p-3 bg-body-tertiary border rounded-3">
            <h2 class="fs-4">Médecins (<?= count($medecins) ?>)</h2>
            <div class="d-flex justify-content-end">
                <a href="?detail=medecin" class="btn btn-sm btn-primary" title="detail">Voir les comptes</a>
            </div>
            </div>
        </div>
        <div class="col-md-6 mt-2">
            <div class="h-100 p-3 bg-body-tertiary border rounded-3">
            <h2 class="fs-4">Certificats (<?= count($nombreEnfants) ?>)</h2>
            <div class="d-flex justify-content-end">
                <a href="?detail=accouchement" class="btn btn-sm btn-primary" title="detail">Voir plus</a>
            </div>
            
            </div>
        </div>
        <div class="col-md-6 mt-2">
            <div class="h-100 p-3 bg-body-tertiary border rounded-3">
            <h2 class="fs-4">Receptionnistes (<?= count($receptionnistes) ?>)</h2>
            <div class="d-flex justify-content-end">
                <a href="?detail=receptionniste" class="btn btn-sm btn-primary me-2" title="Voir +">Détails</a>
                <a href="?detail=receptionniste&action=ajouter" class="btn btn-sm btn-primary" title="Créer un nouveau">Créer</a>
            </div>
            </div>
        </div>
        <div class="col-md-6 mt-2">
            <div class="h-100 p-3 bg-body-tertiary border rounded-3">
            <h2 class="fs-4">Patientes (<?= count($patientes) ?>) </h2>
            <div class="d-flex justify-content-end">
                <a href="?detail=patiente" class="btn btn-sm btn-primary" title="button">Liste</a>
            </div>
            
            </div>
        </div>
        <div class="col-md-6 mt-2">
            <div class="h-100 p-3 bg-body-tertiary border rounded-3">
            <h2 class="fs-4">Accouchement (<?= count($nombreEnfants) ?>)</h2>
            <div class="d-flex justify-content-end">
                <a href="?detail=accouchement" class="btn btn-sm btn-primary" title="Voir +">Détails</a>
            </div>
            </div>
        </div>
        <div class="col-md-6 mt-2">
            <div class="h-100 p-3 bg-body-tertiary border rounded-3">
            <h2 class="fs-4">Consultation (<?=count($consultation)?>)</h2>
            <div class="d-flex justify-content-end">
                <a href="?detail=consultation" class ="btn btn-sm btn-primary"  title="Voir +">Afficher</a>
            </div>
            
            </div>
        </div>
    </div><br><br><br><br><br><br><br>
    <?php } ?>
</div>
<?php
    $contenu = ob_get_clean();
    require '../layout/admin.php';
?>