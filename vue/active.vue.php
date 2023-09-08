<?php
    $titre = "Activation du compte";
    ob_start();
?>
<form method="post" action="" autocomplete="off">
    <div class="d-flex justify-content-center">
        <h1 class="h3 mb-3 fw-normal mt-1 mx-2">Activation du compte</h1>
    </div>
    <?php if(isset($erreur)):?>
      <div class="alert alert-sm alert-danger text-center" style="font-size: small;"><?= $erreur ?></div>
    <?php endif?>
    <?php if(isset($satisfait)):?>
      <div class="alert alert-sm alert-success text-center" style="font-size: small;"><?= $satisfait ?></div>
    <?php endif?>
    <div class="form-floating">
      <input type="text" class="form-control" id="floatingInput" name="code" placeholder="Votre code de confirmation" required>
      <label for="floatingInput">Code d'activation</label>
    </div>
    
    <button class="btn btn-primary w-100 py-2 my-3" type="submit" name="activation">Activez</button>
    
    <p class="mt-5 mb-3 text-body-secondary text-center">&copy; Hôpital 2023</p>
</form>
<?php
    $contenu = ob_get_clean();
    require_once '../layout/base_auth.php';
?>