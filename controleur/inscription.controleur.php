<?php 
    require_once 'auth.requirement.php';
    require_once 'twilio.config.php';
    $tel = "+243";
    $code = strtoupper(substr(uniqid(), 7));
    if(isset($_POST['inscription'])){
        
        extract($_POST);
        if($motDePasse === $configMotDePasse){
            if( str_starts_with($telephone, "0")){
                $telephone = substr($telephone, 1);
            }
            $tel .= $telephone;
            $username_exist = $auth->username_exist($username);
            if($username_exist == 0){
                $insertion = $auth->inscription_medecin([$nom, $username, password_hash($motDePasse, PASSWORD_DEFAULT), $tel, $code]);
                try{
                    $message = "Votre code d'activation est : $code\n 
                        Rendez-vous sur http://localhost/hopital/controleur/active.controleur.php 
                        pour l'activation du compte"
                    ;
                    send_sms($tel, $message);
                }catch(Exception $e){
                    echo 'Probleme de connexion';
                }
                $_SESSION['activation'] = $username;
                header('Location: active.controleur.php');
            }else{
                $erreur = "username déjà utilisé";
            }
        }else{
            $erreur = "Les mots de passe ne correspondent pas";
        }
    }

    require_once '../vue/inscription.vue.php'
?>