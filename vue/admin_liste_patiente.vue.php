<div class="table-responsive small">
    <table class="table table-striped table-sm">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nom</th>
                <th scope="col">Prenom</th>
                <th scope="col">Téléphone</th>
                <th scope="col">Nom Epoux</th>
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
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
</div>