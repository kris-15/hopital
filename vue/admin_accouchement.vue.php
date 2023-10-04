<div class="container">
    <div class="table-responsive small">
        <table class="table table-striped table-sm">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">NOM</th>
                    <th scope="col">SEXE</th>
                    <th scope="col">POIDS</th>
                    <th scope="col">DATE NAIS</th>
                    <th scope="col">TAILLE</th>
                    <th scope="col">APGAR</th>
                    <th scope="col">PC</th>
                    <th scope="col">PARENTS</th>
                    <th scope="col" class="text-center">Options</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($enfants as $enfant): ?>
                    <tr>
                        <td><?= $cpt++ ?></td>
                        <td><?= strtoupper($enfant->nom_enfant)?></td>
                        <td><?= strtoupper($enfant->sexe)?></td>
                        <td><?= $enfant->poids ?> g</td>
                        <td><?= ($enfant->date_formatee)?></td>                       
                        <td><?= $enfant->taille ?> cm</td>
                        <td><?= $enfant->apgar ?></td>
                        <td><?= $enfant->pc ?></td>
                        <td><?= strtoupper($enfant->nom_mamam) . ' & '. strtoupper($enfant->papa)?></td>
                        <td class="d-flex justify-content-center">
                            <a href="../vue/certificat.php?id_enfant=<?= $enfant->id_enfant ?>" class="btn btn-sm btn-outline-primary">Voir certificat</a>
                        </td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </div>
</div>
