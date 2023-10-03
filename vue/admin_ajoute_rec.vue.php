<?php 
  require '../layout/BootstrapComponents.php' ;
  $place = "Tapez le nom du receptionniste";
  $btn = "recherche_rec";
?>
<div class="container ">
    <div class=" d-flex justify-content-end my-3">
        <div class=""><a href="../controleur/admin.php" class="btn btn-primary btn-sm mt-2" title="Retour">Retournez à l'accueil</a></div>
    </div>
    
    <?php if(isset($ajouter) OR isset($modifier)): ?>
        <div class=" d-flex justify-content-end my-3">
            <div class=""><a href="?detail=receptionniste" class="btn btn-primary btn-sm mt-2" title="Lister">Afficher la liste</a></div>
        </div>
    <form method="post" action="" autocomplete="off">
        <?php if(isset($satisfait)):?>
            <div class="alert alert-sm alert-success text-center" style="font-size: small;"><?= $satisfait ?></div>
        <?php endif?>
        <?php if(isset($erreurForm)):?>
            <div class="alert alert-sm alert-danger text-center" style="font-size: small;"><?= $erreurForm ?></div>
        <?php endif?>
        <?= BootstrapComponent::form_input('text', 'nom', "Nom de la personne", valeur:$receptionniste->nom??'')?>
        <?= BootstrapComponent::form_input('text', 'prenom', "Prénom de la personne", valeur:$receptionniste->prenom??'')?>
        <?= BootstrapComponent::form_input('text', 'telephone', "Son numéro de téléphone", valeur:$receptionniste->telephone??'')?>
        <button class="btn btn-primary w-100 py-2 my-2" type="submit" name="<?= isset($modifier)?'modifier':'enregistrer'?>"><?= isset($modifier)?'Modifier':'Ajouter'?></button>
    </form>
    <?php else: ?>
        <?php require 'recherche.vue.php' ?>
        <?php if(isset($erreur)):?>
            <div class="alert alert-sm alert-danger text-center" style="font-size: small;"><?= $erreur ?></div>
        <?php endif?>
        <?php if(isset($succes)):?>
            <div class="alert alert-sm alert-success text-center" style="font-size: small;"><?= $succes ?></div>
        <?php endif?>
        <div class=" d-flex justify-content-end my-3">
            <div class=""><a href="?detail=receptionniste&action=ajouter" class="btn btn-primary btn-sm mt-2" title="Ajouter">Enregistrer un nouveau</a></div>
        </div>
        <div class="table-responsive small">
            <table class="table table-striped table-sm">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nom</th>
                        <th scope="col">Prenom</th>
                        <th scope="col">Code</th>
                        <th scope="col" class="text-center">Options</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        if($receptionnistes == null || $receptionnistes == false){
                            echo '<p class="text-center text-danger">Pas de receptionniste trouvé</p>';
                        }else{
                    ?>
                    <?php foreach($receptionnistes as $receptionniste): ?>
                        <tr>
                            <td><?= $cpt++ ?></td>
                            <td><?= strtoupper($receptionniste->nom)?></td>
                            <td><?= ucfirst($receptionniste->prenom)?></td>
                            <td><?= $receptionniste->code?></td>
                            <td class="d-flex justify-content-center">
                                <a href="?detail=receptionniste&action=modifier&id=<?= ($receptionniste->id)?>" class="btn btn-sm btn-primary mx-1">Modifier</a>
                                <a href="?detail=receptionniste&action=supprimer&id=<?= $receptionniste->id ?>" class="btn btn-sm btn-danger">Supprimer</a>
                            </td>
                        </tr>
                    <?php endforeach ?>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    <?php endif ?>
</div>