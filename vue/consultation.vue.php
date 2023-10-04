<?php
    $titre = $lead = "Nouveau né";
    ob_start();
    require_once "../layout/BootstrapComponents.php";
    $class = count($consultations)%2==0 ? "col-md-6": 'col-md-4';
    $class = count($consultations)%3==0 ? "col-md-4": 'col-md-6';
?>
<?php if(isset($stop)): ?>
    <div class="alert alert-warning text-center fw-bold"><?= $stop ?></div>
<?php else: ?>
<p>Patiente : <span class="fw-bold h3"><?= strtoupper($patiente->nom).' '.ucfirst($patiente->prenom) ?></span></p>
<hr>
<h2>Les précédentes consultations (<?= count($consultations)?>)</h2>
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
<h2 class="text-center">Nouvelle consultation</h2>

    <?php if(isset($erreur)):?>
        <div class="alert alert-danger text-center"><?= $erreur ?></div>
    <?php endif ?>
    <?php if(isset($satisfait)): ?>
        <div class="alert alert-success text-center"><?= $satisfait ?></div>
    <?php endif ?>
    
    <form action="" method="post" class="form">
        <fieldset class="border p-4  my-3">
            <legend>Info de la consultation</legend>
            <?= BootstrapComponent::form_input('number', 'poids', "Le poids de la patiente", max:200, min: 40)?>
            <?= BootstrapComponent::form_input('number', 'temperature', "La température de la patiente en °C", max: 45, min: 36)?>
            <?= BootstrapComponent::form_input('number', 'tension', "La tension de la patiente", max: 190, min: 85)?>
            <?= BootstrapComponent::form_textarea('observation', "Observation de la consultation")?>
        </fieldset>
        <button type="submit" class="btn btn-primary w-100 py-2 my-2" name="enregistrer">Enregistrer</button>
    </form>
<?php endif ?>
<?php 
    $contenu = ob_get_clean();
    require_once "../layout/admin.php";
?>    