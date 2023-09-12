<?php
$titre = $lead = "Nouveau né";
ob_start();
require_once "../layout/BootstrapComponents.php";
?>
<p>Mere : <span class="fw-bold h2"><?= strtoupper($patiente->nom).' '.ucfirst($patiente->prenom) ?></span></p>
<hr>
<h2 class="text-center">Enregistrer un nouveau né</h2>
<?php if(isset($stop)): ?>
    <div class="alert alert-warning text-center fw-bold"><?= $stop ?></div>
<?php else: ?>
    <form action="" method="post" class="form">
        <?= BootstrapComponent::form_input("text", 'nom', "Le nom complet provisoire de l'enfant", required:false)?>
        <?= BootstrapComponent::form_select("etat", ["MORT"=>"MORT", "VIVANT"=>"VIVANT"], "Etat de l'enfant")?>
        <?= BootstrapComponent::form_select("sexe", ["FEMININ"=>"FEMININ", "MASCULIN"=>"MASCULIN"], "Le sexe de l'enfant")?>
        <?= BootstrapComponent::form_input("number", "poids", "Le poids en grammes", min:1000) ?>
        <?= BootstrapComponent::form_input("date", "dateNais", "La date de naissance de l'enfant", max: date('Y-m-d')) ?>
        <button type="submit" class="btn btn-primary w-100 py-2 my-2" name="enregistrer">Enregistrer</button>
    </form>
<?php endif ?>
<?php 
    $contenu = ob_get_clean();
    require_once "../layout/admin.php";
?>    