<div class="container">
    <div class=" d-flex justify-content-end my-3">
        <div class=""><a href="../controleur/admin.php" class="btn btn-primary btn-sm mt-2" title="Retour">Retournez à l'accueil</a></div>
    </div>
    <div class="d-flex justify-content-between">
        <h2>Les consultations effectuées (<?= count($consultations)?>)</h2>
        <div class="">
        <button class="btn btn-primary" onclick="window.print()">Imprimer</button>
        </div>
    </div>
    <?php if(count($consultations) == 0): ?>
        <div class="alert alert-warning">Aucune consultation précédente enrégistrée</div>
    <?php else: ?>
        <div class="row">
            <?php foreach($consultations as $consultation): ?>
                <div class="<?=$class ?>">
                    <span class="fw-bold">Consultation N° <?=$consultation->id_consultation?></span> <br>
                    <table>
                        <tbody>
                            <tr>
                                <th>Date : </th>
                                <td><?= $consultation->date_formatee ?> </td>
                            </tr>
                            <tr>
                                <th>Noms patiente : </th>
                                <td><?= strtoupper($consultation->nom_patiente) .' '. ucfirst($consultation->prenom_patiente)?> </td>
                            </tr>
                            <tr>
                                <th>Poids : </th>
                                <td><?= $consultation->poids_patiente ?> Kg</td>
                            </tr>
                            <tr>
                                <th>Température : </th>
                                <td><?= $consultation->temperature ?> °C</td>
                            </tr>
                            <tr>
                                <th>Tension : </th>
                                <td><?= $consultation->tension ?></td>
                            </tr>
                            <tr>
                                <th>Observation : </th>
                                <td><?= $consultation->observation ?> </td>
                            </tr>
                            <tr>
                                <th>Consultée par : </th>
                                <td>Dr <?= $consultation->nom_medecin ?> </td>
                            </tr>
                        </tbody>
                    </table>
                    <hr>
                </div>
            <?php endforeach ?>
            <hr>
        </div>
    <?php endif ?>
</div>