<?php 
    $titre = "Connexion";
    ob_start();
?>
<form method="post" action="" autocomplete="off">
    <div class="d-flex justify-content-center">
        <img class="mb-4" src="../assets/brand/bootstrap-logo.svg" alt="" width="52" height="37">
        <h1 class="h3 mb-3 fw-normal mt-1 mx-2">Connexion</h1>
    </div>
    <?php if(isset($erreur)):?>
      <div class="alert alert-sm alert-danger text-center" style="font-size: small;"><?= $erreur ?></div>
    <?php endif?>
    <?php if(isset($satisfait)):?>
      <div class="alert alert-sm alert-success text-center" style="font-size: small;"><?= $satisfait ?></div>
    <?php endif?>
    <div class="form-floating">
      <input type="text" class="form-control" id="floatingInput" name="username" placeholder="Votre username" value="<?= $_POST['username'] ?? ''?>" required>
      <label for="floatingInput">Username</label>
    </div>
    <div class="form-floating">
      <input type="password" class="form-control" id="floatingPassword" name="motDePasse" placeholder="Password" required>
      <label for="floatingPassword">Mot de passe</label>
    </div>

    <div class="form-check text-start my-3">
      <input class="form-check-input" type="checkbox" name="log" value="remember-me" id="flexCheckDefault">
      <label class="form-check-label" for="flexCheckDefault">
        Se souvenir de moi
      </label>
    </div>
    <button class="btn btn-primary w-100 py-2" type="submit" name="connexion">Se connecter</button>
    <div class="text-center my-2">
        <a href="inscription.controleur.php" class="link text-center">Créer mon compte</a>
    </div>
    <p class="mt-5 mb-3 text-body-secondary text-center">&copy; Hôpital 2023</p>
</form>
<?php
    $contenu = ob_get_clean();
    require_once '../layout/base_auth.php';
?>