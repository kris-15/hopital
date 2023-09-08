<?php
require '../modele/Modele.php';
class Authentification extends Model{

    /**
     * Permet d'inscrire un nouvel admin
     * @param array $infoAdmin les informations relatives  l'administrateur
     * @return bool $insertion Selon que l'enregitrement a été fait ou non 
     */
    public function inscription_admin(array $infoAdmin){
        $sql = "INSERT INTO admins (nom, username, mot_de_passe, telephone, code) VALUE (?, ?, ?, ?, ?)";
        $insertion = $this->prepare_sql($sql, $infoAdmin);
        return $insertion;
    }

    /**
     * Permet de vérifier les informations de la connexion : username & mot de passe
     * @param string $username Le username de l'utilisateur
     * @param string $password Le mot de passe de l'utilisateur
     * @return array||bool selon que les information sont correctes ou non 
     */
    public function connexion_admin($username, $password){
        $sql = "SELECT * FROM admins WHERE username = ?";
        $admin = $this->prepare_sql($sql, [$username], fetchOne: true);
        if($admin){
            $test = password_verify($password, $admin["mot_de_passe"]);
        }
        
        return $admin ?? false;
    }

    /**
     * Permet de vérifier si le username a déjà été utilisé
     * @param string $username Le username à checker
     * @return int $exist Le nombre de fois utilisé
     */
    public function username_exist($username){
        $sql = "SELECT count(id) FROM admins WHERE username = ?";
        $exist = $this->prepare_sql($sql, [$username], fetchColumn: true);
        return $exist;

    }
    /**
     * Permet l'activation d'un compte admin en attente
     * @param string $username Le username de l'admin
     * @param string $code Le code d'activation reçu après enregistrement
     */
    public function activer_compte($username, $code){
        $sql = "SELECT * FROM admins WHERE username = ? AND code = ?";
        $admin = $this->prepare_sql($sql, [$username, $code], fetchOne: true);
        if($admin){
            $sql = "UPDATE admins SET statut_compte = ? WHERE username = ? AND code = ?";
            $modification = $this->prepare_sql($sql, ["ACTIVE", $admin['username'], $admin['code']]);
            return $modification;
        }
        return false;
    }

    /**
     * Permet de chercher un admin à partir de son username
     * @param string $username Le username de l'admin cherché
     * @return array||bool $check Selon que l'admin est trouvé ou non.
     */
    public function check_admin_by_username($username){
        $sql = "SELECT * FROM admins WHERE username = ?";
        $check = $this->prepare_sql($sql, [$username], fetchOne: true);
        return $check;
    }

}