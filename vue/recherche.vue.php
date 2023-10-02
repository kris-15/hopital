<form action="" method="post" class="d-flex my-2">
    <input type="text" name="nom" id="" placeholder="<?= isset($place)? $place:"Nom de la patiente" ?>" class="form-control me-2">
    <button type="submit" name="<?= isset($btn)? $btn:"recherche" ?>" class="btn btn-sm btn-primary">Rechercher</button>
 
</form>