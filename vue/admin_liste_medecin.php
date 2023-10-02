<?php 
    $place = "Tapez le nom du médecin à rechercher ";
    $btn = "recherche_medecin"
?>
<div class="container">
    <div class=" d-flex justify-content-end my-3">
        <div class=""><a href="../controleur/admin.php" class="btn btn-primary btn-sm mt-2" title="Enregistrer">Retournez à l'accueil</a></div>
    </div>
    <?php require 'recherche.vue.php' ?>
    <div class="table-responsive small">
        <table class="table table-striped table-sm">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nom</th>
                    <th scope="col">Username</th>
                    <th scope="col">Téléphone</th>
                    <th scope="col" class="text-center">Option</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                    if($medecins == null || $medecins == false){
                        echo '<p class="text-center text-danger">Pas de médecin trouvé</p>';
                    }else{
                ?>
                <?php foreach($medecins as $medecin): ?>
                    <tr>
                        <td><?= $cpt++ ?></td>
                        <td><?= strtoupper($medecin->nom)?></td>
                        <td><?= ($medecin->username)?></td>
                        <td><?= $medecin->telephone ?></td>
                        <td class="d-flex justify-content-center">
                            <?php if($medecin->statut_compte == "ACTIVE"): ?>
                                <a href="../controleur/admin.php?block=<?= ($medecin->id)?>" class="btn btn-sm btn-danger mx-1">DESACTIVE COMPTE</a>
                            <?php elseif($medecin->statut_compte == "EN ATTENTE"): ?>
                                <a href="../controleur/admin.php?deblock=<?= $medecin->id ?>" class="btn btn-sm btn-success">ACTIVE COMPTE</a>
                            <?php else:?>
                                <span class="badge bg-warning">Compte en attente d'activation</span>
                            <?php endif ?>
                        </td>
                    </tr>
                <?php endforeach ?>
                <?php }?>
            </tbody>
        </table>
    </div>
</div>