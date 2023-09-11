<?php 
  require '../layout/BootstrapComponents.php' ;
  $listeCommune = [
    "BANDALUNGWA"=>"BANDALUNGWA",
    "BARUMBU"=>"BARUMBU",
    "BUMBU"=>"BUMBU",
    "GOMBE"=>"GOMBE",
    "KALAMU"=>"KALAMU",
    "KASA-VUBU"=>"KASA-VUBU",
    "KIMBANSEKE"=>"KIMBANSEKE",
    "KISENSO"=>"KISENSO",
    "KINTAMBO"=>"KINTAMBO",
    "LEMBA"=>"LEMBA",
    "LIMETE"=>"LIMETE",
    "LINGWALA"=>"LINGWALA",
    "MAKALA"=>"MAKALA",
    "MALUKU"=>"MALUKU",
    "MASINA"=>"MASINA",
    "MATETE"=>"MATETE",
    "MONT-NGAFULA"=>"MONT-NGAFULA",
    "NDJILI"=>"NDJILI",
    "NGABA"=>"NGABA",
    "NGALIEMA"=>"NGALIEMA",
    "NGIRI-NGIRI"=>"NGIRI-NGIRI",
    "NSELE"=>"NSELE",
    "SELEMBAO"=>"SELEMBAO",
  ];
  $dateActuelle = new DateTime();
  $dateActuelle->modify('-15 years');
  $dateLimite = $dateActuelle->format('Y-m-d');
?>
<h2 class="text-center">Nouvel enregistrement</h2>
<form method="post" action="" autocomplete="off">
    <?php if(isset($erreur)):?>
      <div class="alert alert-sm alert-danger text-center" style="font-size: small;"><?= $erreur ?></div>
    <?php endif?>
    <?php if(isset($satisfait)):?>
      <div class="alert alert-sm alert-success text-center" style="font-size: small;"><?= $satisfait ?></div>
    <?php endif?>
    <div class="row">
      <div class="col-md-4">
        <?= BootstrapComponent::form_input('text', 'nomDame', "Nom de la patiente")?>
      </div>
      <div class="col-md-4">
        <?= BootstrapComponent::form_input('text', 'prenomDame', "Prénom de la patiente")?>
      </div>
      <div class="col-md-4">
        <?= BootstrapComponent::form_input('text', 'monsieur', "Nom de l'époux")?>
      </div>
    </div>
    <div class="row">
      <div class="col-md-6">
        <?= BootstrapComponent::form_input('date', 'dateNais', "Date de naissance", max: $dateLimite)?>
      </div>
      <div class="col-md-6">
        <?= BootstrapComponent::form_input('text', 'telephone', "Numéro de téléphone")?>
      </div>
    </div>
    <div class="row">
      <div class="col-md-3">
        <?= BootstrapComponent::form_input('text', 'avenue', "Avenue de la patiente")?>
      </div>
      <div class="col-md-3">
        <?= BootstrapComponent::form_input('text', 'numero', "N° de l'habitation de la patiente")?>
      </div>
      <div class="col-md-3">
        <?= BootstrapComponent::form_input('text', 'quartier', "Quartier de la patiente")?>
      </div>
      <div class="col-md-3">
        <?= BootstrapComponent::form_select('commune', $listeCommune, "Commune") ?>
      </div>
    </div>
    
    <button class="btn btn-primary w-100 py-2 my-2" type="submit" name="enregistrer">Enregistrer</button>
</form>