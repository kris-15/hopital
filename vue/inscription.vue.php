<?php 
    $titre = "Inscription";
    ob_start();
?>
<form method="post" action="" autocomplete="off">
    <div class="d-flex justify-content-center">
        <img class="mb-4" src="../assets/brand/bootstrap-logo.svg" alt="" width="52" height="37">
        <h1 class="h3 mb-3 fw-normal mt-1 mx-2">Inscription</h1>
    </div>
    <?php if(isset($erreur)):?>
      <div class="alert alert-sm alert-danger text-center" style="font-size: small;"><?= $erreur ?></div>
    <?php endif?>
    <?php if(isset($satisfait)):?>
      <div class="alert alert-sm alert-success text-center" style="font-size: small;"><?= $satisfait ?></div>
    <?php endif?>
    <div class="form-floating">
      <input type="text" class="form-control" id="floatingInput" name="nom" placeholder="Votre nom complet" value="<?= $_POST['nom'] ?? ''?>" required>
      <label for="floatingInput">Nom complet</label>
    </div>
    <div class="form-floating my-2">
      <input type="text" class="form-control" id="floatingInput" name="username" placeholder="Créez un username unique" value="<?= $_POST['username'] ?? ''?>" required>
      <label for="floatingInput">Username</label>
    </div>
    <div class="form-floating my-2">
      <input type="number" class="form-control" id="floatingInput" name="telephone" placeholder="Créez un username unique" value="<?= $_POST['telephone'] ?? ''?>" required>
      <label for="floatingInput">Votre numero de téléphone</label>
    </div>
    
    <div class="form-floating">
      <input type="password" class="form-control" id="floatingInput" name="motDePasse" placeholder="Password" required>
      <label for="floatingInput">Créez votre Mot de passe</label>
    </div>
    <div class="form-floating">
      <input type="password" class="form-control" id="floatingInput" name="configMotDePasse" placeholder="Confirmez le mot de passe" required>
      <label for="floatingInput">Confirmez votre Mot de passe</label>
    </div>

    <button class="btn btn-primary w-100 py-2" type="submit" name="inscription">Enregistrer</button>
    <div class="text-center my-2">
        <a href="connexion.controleur.php" class="link text-center">Se connecter</a>
    </div>
    <p class="mt-5 mb-3 text-body-secondary text-center">&copy; Hôpital 2023</p>
</form>
<?php
    $contenu = ob_get_clean();
    require_once '../layout/base_auth.php';
?>