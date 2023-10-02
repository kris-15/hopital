<?php
    $lead = "Receptionniste / Liste des patientes";
    if(isset($ajouter))$lead = "Receptionniste / Enregistrement patiente";
    if(isset($modifier))$lead = "Receptionniste / Modification Information patiente";
    $cpt = 1;
    ob_start();
?>
<div class="container">
    <?php if(isset($ajouter) OR isset($modifie)):?>
        <?php require "ajouter.vue.php" ?>
    <?php else: ?>

        <div class=" d-flex justify-content-end my-3">
            <div class=""><a href="?ajouter=oui" class="btn btn-primary btn-sm mt-2" title="Enregistrer">Nouvelle patiente</a></div>
        </div>
        <?php require 'recherche.vue.php' ?>
        <div class="table-responsive small">
            <table class="table table-striped table-sm">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nom</th>
                        <th scope="col">Prenom</th>
                        <th scope="col">Téléphone</th>
                        <th scope="col">Nom Epoux</th>
                        <th scope="col" class="text-center">Options</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($patientes as $patiente): ?>
                        <tr>
                            <td><?= $cpt++ ?></td>
                            <td><?= strtoupper($patiente->nom)?></td>
                            <td><?= ucfirst($patiente->prenom)?></td>
                            <td><?= $patiente->telephone ?></td>
                            <td><?= strtoupper($patiente->epoux)?></td>
                            <td class="d-flex justify-content-center">
                                <a href="../controleur/index.receptionniste.php?modifie=<?= ($patiente->id)?>" class="btn btn-sm btn-outline-primary mx-1">Modifier</a>
                                <a href="../controleur/index.receptionniste.php?supprimer=<?= $patiente->id ?>" class="btn btn-sm btn-outline-danger">Supprimer</a>
                            </td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    <?php endif ?>
    </div>
<?php 
    $contenu = ob_get_clean();
    require '../layout/admin.php';
?>