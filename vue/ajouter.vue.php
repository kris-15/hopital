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
<div class="container ">
  <div class="d-flex justify-content-end my-3">
    <a href="../controleur/index.receptionniste.php" class="btn btn-sm btn-primary">Afficher la liste</a>
  </div>
  <form method="post" action="" autocomplete="off">
      <?php if(isset($erreur)):?>
        <div class="alert alert-sm alert-danger text-center" style="font-size: small;"><?= $erreur ?></div>
      <?php endif?>
      <?php if(isset($satisfait)):?>
        <div class="alert alert-sm alert-success text-center" style="font-size: small;"><?= $satisfait ?></div>
      <?php endif?>
      
        <?= BootstrapComponent::form_input('text', 'nomDame', "Nom de la patiente", valeur:$patiente->nom??'')?>
        <?= BootstrapComponent::form_input('text', 'prenomDame', "Prénom de la patiente", valeur:$patiente->prenom??'')?>
      
        <?= BootstrapComponent::form_input('text', 'monsieur', "Nom de l'époux", valeur:$patiente->epoux??'')?>
      
        <?= BootstrapComponent::form_input('date', 'dateNais', "Date de naissance", max: $dateLimite, valeur:$patiente->date_naissance??'')?>
      
        <?= BootstrapComponent::form_input('text', 'telephone', "Numéro de téléphone", valeur:$patiente->telephone??'')?>
      
        <?= BootstrapComponent::form_input('text', 'avenue', "Avenue de la patiente", valeur:$adresse->avenue??'')?>
      
        <?= BootstrapComponent::form_input('text', 'numero', "N° de l'habitation de la patiente", valeur:$adresse->numero??'')?>
      
        <?= BootstrapComponent::form_input('text', 'quartier', "Quartier de la patiente", valeur:$adresse->quartier??'')?>
      
        <?= BootstrapComponent::form_select('commune', $listeCommune, "Commune", checked:$adresse->commune??'') ?>
      
      <button class="btn btn-primary w-100 py-2 my-2" type="submit" name="<?= isset($modifie)?'modifier':'enregistrer'?>"><?= isset($modifie)?'Modifier':'Enregistrer'?></button>
  </form>
</div>