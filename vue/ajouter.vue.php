<?php require '../layout/BootstrapComponents.php' ?>
<h2 class="text-center">Nouvel enregistrement</h2>
<form method="post" action="" autocomplete="off">
    <?php if(isset($erreur)):?>
      <div class="alert alert-sm alert-danger text-center" style="font-size: small;"><?= $erreur ?></div>
    <?php endif?>
    <?php if(isset($satisfait)):?>
      <div class="alert alert-sm alert-success text-center" style="font-size: small;"><?= $satisfait ?></div>
    <?php endif?>
    <?= BootstrapComponent::form_input('text', 'dame', "Nom de la dame")?>
    <?= BootstrapComponent::form_input('text', 'monsieur', "Nom du monsieur")?>
    <?= BootstrapComponent::form_input('date', 'dateAccouchement', "Date d'accouchement", max: date('Y-m-d'))?>
    <?= BootstrapComponent::form_select('voie', ["BASSE"=>"VOIE BASSE", "CESARIENNE"=>"CESARIENNE"], "La voie de l'accouchement") ?>
    <?= BootstrapComponent::form_select('sexe', ["MASCULIN"=>"MASCULIN", "FEMININ"=>"FEMININ"], "Sexe de l'enfant") ?>
    <?= BootstrapComponent::form_input('number', 'poids', "Poids de l'enfant en Grammes", min:1000)?>

    <button class="btn btn-primary w-100 py-2 my-2" type="submit" name="enregistrer">Enregistrer</button>
</form>