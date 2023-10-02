<?php 
    $lead = "Admin - Dashboard";
    $titre = "Admin - Dashboard";
    ob_start();
?>

<div class="container">
    <?php 
        if(isset($detailMedecin)){
            require_once 'admin_liste_medecin.php';
        }else{ 
    ?>
    <div class="d-flex justify-content-end">
        <a href="" class="btn btn-sm btn-primary">Imprimer les détails</a>
    </div>
    <div class="row align-items-md-stretch">
        <div class="col-md-6 mt-2">
            <div class="h-100 p-3 bg-body-tertiary border rounded-3">
            <h2 class="fs-4">Médecins (<?= count($medecins) ?>)</h2>
            <div class="d-flex justify-content-end">
                <a href="?detail=medecin" class="btn btn-sm btn-primary" title="button">Détails</a>
            </div>
            </div>
        </div>
        <div class="col-md-6 mt-2">
            <div class="h-100 p-3 bg-body-tertiary border rounded-3">
            <h2 class="fs-4">Certificats (<?= count($receptionnistes) ?>)</h2>
            <div class="d-flex justify-content-end">
                <a href="" class="btn btn-sm btn-primary" title="button">Détails</a>
            </div>
            
            </div>
        </div>
        <div class="col-md-6 mt-2">
            <div class="h-100 p-3 bg-body-tertiary border rounded-3">
            <h2 class="fs-4">Receptionnistes (<?= count($receptionnistes) ?>)</h2>
            <div class="d-flex justify-content-end">
                <a href="#" class="btn btn-sm btn-primary" type="button">Détails</a>
            </div>
            </div>
        </div>
        <div class="col-md-6 mt-2">
            <div class="h-100 p-3 bg-body-tertiary border rounded-3">
            <h2 class="fs-4">Patientes (<?= count($patientes) ?>) </h2>
            <div class="d-flex justify-content-end">
                <a href="" class="btn btn-sm btn-primary" title="button">Détails</a>
            </div>
            
            </div>
        </div>
        <div class="col-md-6 mt-2">
            <div class="h-100 p-3 bg-body-tertiary border rounded-3">
            <h2 class="fs-4">Accouchement (<?= count($accouchements) ?>)</h2>
            <div class="d-flex justify-content-end">
                <a href="#" class="btn btn-sm btn-primary" type="button">Détails</a>
            </div>
            </div>
        </div>
        <div class="col-md-6 mt-2">
            <div class="h-100 p-3 bg-body-tertiary border rounded-3">
            <h2 class="fs-4">Nouveau-né (<?=count($enfants)?>)</h2>
            <div class="d-flex justify-content-end">
                <a href="" class ="btn btn-sm btn-primary"  title="button">Détails</a>
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