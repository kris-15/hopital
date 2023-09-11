<?php
    $lead = "Dashboard";
    ob_start();
    $cpt = 1;
?>
<?= $salutation ?>

<?php require_once '../vue/ajouter.vue.php' ?>

<hr>
<h2 class="text-center mb-3">Les patientes enregistrées</h2>
<div class="table-responsive small">
    <table class="table table-striped table-sm">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nom</th>
                <th scope="col">Prenom</th>
                <th scope="col">Téléphone</th>
                <th scope="col">Nom Epoux</th>
                <th scope="col">Options</th>
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
                    <td>
                        <a href="<?= ($patiente->id)?>" class="btn btn-sm btn-outline-success">Consulter</a>
                    </td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
</div>
<?php
    $contenu = ob_get_clean();
    require_once '../layout/admin.php'; 
?>