<?php
    $lead = "Dashboard";
    $titre = "Médecin";
    if(isset($voirConsultation))$lead = "Rapport des consultations";
    if(isset($voirEnfants))$lead = "Rapport des accouchements";
    ob_start();
    $cpt = 1;
    
    $class = count($consultations)%2==0 ? "col-md-6": 'col-md-4';
    $class = count($consultations)%3==0 ? "col-md-4": 'col-md-6';
?>
<?php if(isset($voirConsultation)): ?>
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
<?php elseif(isset($voirEnfants)): ?>
    <h2 class="text-center mb-3">Les enfants enregistrées</h2>
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
                            <a href="../vue/certificat.php" class="btn btn-sm btn-outline-primary">Imprimer certificat</a>
                        </td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </div>
<?php else: ?>

<?php require_once '../vue/recherche.vue.php' ?>
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
                        <a href="../controleur/consultation.controleur.php?patiente=<?= ($patiente->id)?>" class="btn btn-sm btn-outline-success mx-1">Consulter</a>
                        <a href="../controleur/enfant.controleur.php?maman=<?= $patiente->id ?>" class="btn btn-sm btn-outline-primary">Acchoucher</a>
                    </td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
</div>
<?php endif ?>
<?php
    $contenu = ob_get_clean();
    require_once '../layout/admin.php'; 
?>