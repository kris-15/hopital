<?php
    $titre = $lead = "Nouveau né";
    ob_start();
    require_once "../layout/BootstrapComponents.php";
    $dateActuelle = new DateTime();
    $dateActuelle->modify('-5 days');
    $dateLimite = $dateActuelle->format('Y-m-d');
?>
<p>Mere : <span class="fw-bold h2"><?= strtoupper($patiente->nom).' '.ucfirst($patiente->prenom) ?></span></p>
<hr>
<h2 class="text-center">Enregistrer un nouveau né</h2>
<?php if(isset($stop)): ?>
    <div class="alert alert-warning text-center fw-bold"><?= $stop ?></div>
<?php else: ?>
    <?php if(isset($erreur)):?>
        <div class="alert alert-danger text-center"><?= $erreur ?></div>
    <?php endif ?>
    <?php if(isset($satisfait)): ?>
        <div class="alert alert-success text-center"><?= $satisfait ?></div>
    <?php endif ?>
    
    <form action="" method="post" class="form">
        <fieldset class="border p-4  my-3">
            <legend>Partie maman</legend>
            <?= BootstrapComponent::form_input('date', 'dateNais', "Date d'accouchement", max: date('Y-m-d'), min: $dateLimite)?>
            <?= BootstrapComponent::form_textarea('observation_maman', "Observation de l'accouchement")?>
            <?= BootstrapComponent::form_select('voie', ["VOIE BASSE"=>"VOIE BASSE", "CESARIENNE"=>"CESARIENNE"], "Voie d'accouchement")?>
            <?= BootstrapComponent::form_select('type', ["EUTOCIQUE"=>"EUTOCIQUE", "DYSTOCIQUE"=>"DYSTOCIQUE"], "Type d'accouchement")?>
            <?= BootstrapComponent::form_select('vih', ["POSITIF"=>"POSITIF", "NEGATIF"=>"NEGATIF"], "Le test de VIH")?>
        </fieldset>
        <fieldset class="border p-4 mb-3 ">
            <legend>Partie enfant</legend>
            <?= BootstrapComponent::form_input("text", 'nom', "Le nom complet provisoire de l'enfant", required:false, min:3)?>
            <?= BootstrapComponent::form_select("etat", ["MORT"=>"MORT", "VIVANT"=>"VIVANT"], "Etat de l'enfant")?>
            <?= BootstrapComponent::form_select("sexe", ["FEMININ"=>"FEMININ", "MASCULIN"=>"MASCULIN"], "Le sexe de l'enfant")?>
            <?= BootstrapComponent::form_input("number", "poids", "Le poids en grammes", min:1000) ?>
            <?= BootstrapComponent::form_input("number", "taille", "La taille de l'enfant en cm", min:30, max:100) ?>
            <?= BootstrapComponent::form_input("text", "apgar", "Apgar") ?>
            <?= BootstrapComponent::form_input("number", "pc", "Le périmètre cranien de l'enfant en cm", min:1) ?>
            <?= BootstrapComponent::form_textarea('observation_enfant', 'Observation')?>
        </fieldset>
        <button type="submit" class="btn btn-primary w-100 py-2 my-2" name="enregistrer">Enregistrer</button>
    </form>
<?php endif ?>
<?php 
    $contenu = ob_get_clean();
    require_once "../layout/admin.php";
?>    