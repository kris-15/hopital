<?php
require '../modele/Modele.php';
class Receptionniste extends Model{
    public $id;
    public $login;
    public $motDePasse;

    
    /**
     * Permet d'ajouter une patiente
     * @param array $infoPatiente Les informations de la nouvelle patiente
     * @param array $infoAdressePatiente Les informations sur l'adresse de la patiente
     */
    public function ajouter_patiente(array $infoPatiente, array $infoAdressePatiente){
        $sql = "INSERT INTO patientes (nom, prenom, telephone, code, date_naissance, epoux) VALUE (?,?,?,?,?,?)";
        $ajoutPatient = $this->prepare_sql($sql, $infoPatiente);
        $patiente = $this->patient_enregistre($infoPatiente);
        array_push($infoAdressePatiente, $patiente->id);
        return $this->ajouter_adresse($infoAdressePatiente);
    }
    /**
     * Permet d'ajouter une patiente
     * @param array $infoPatiente Les informations de la nouvelle patiente
     * @param array $infoAdressePatiente Les informations sur l'adresse de la patiente
     */
    public function modifier_patiente(array $infoPatiente, array $infoAdressePatiente){
        $sql = "UPDATE patientes SET nom=?,prenom=?,telephone=?,date_naissance=?,epoux=? WHERE id = ?";
        $modifierPatient = $this->prepare_sql($sql, $infoPatiente);
        return $this->modifier_adresse($infoAdressePatiente);
    }

    private function patient_enregistre(array $infoPatiente){
        $sql = "SELECT id FROM patientes WHERE nom = ? AND prenom = ? AND telephone = ? AND code = ? AND date_naissance = ? AND epoux = ?";
        return $this->prepare_sql($sql, $infoPatiente, fetchOne: true, fetchMode: PDO::FETCH_OBJ);
    }

    private function ajouter_adresse(array $infoAdresse){
        $sql = "INSERT INTO adresses VALUE (null,?,?,?,?,?)";
        return $this->prepare_sql($sql, $infoAdresse);
    }
    private function modifier_adresse(array $infoAdresse){
        $sql = "UPDATE adresses SET avenue=?, numero=?, quartier=?, commune=? WHERE patient_id=?";
        return $this->prepare_sql($sql, $infoAdresse);
    }

    public function supprimer_patiente($id){
        if($this->find_patiente($id)){
            return $this->prepare_sql("DELETE FROM patientes WHERE id=?",[$id]);
        }
        return false;
    }
    

    /**
     * Permet de vérifier si le code a déjà été utilisé
     * @param string $code Le code à vérifier
     * @return int $reponse Le nombre des fois que le code a été utilisé
     */
    public function verifier_code($code){
        return $this->prepare_sql("SELECT count(id) FROM patientes WHERE code = ?", [$code], fetchColumn:true);
    }

    /**
     * Permet de récupérer tous les patientes enregistrées
     * @return array $lesPatientes La liste des patientes
     */
    public function get_patientes(){
        return $this->prepare_sql("SELECT * FROM patientes", [], fetch: true, fetchMode: PDO::FETCH_OBJ); 
    }

    public function get_patientes_by_nom($nomPatiente){
        return $this->prepare_sql("SELECT * FROM patientes WHERE nom LIKE ?", ["%$nomPatiente%"], fetch: true, fetchMode: PDO::FETCH_OBJ);
    }
    /**
     * Recupère les informations d'une patiente au moyen de son id
     * @param int $id L'identifiant de la patient
     * @return array
     */
    public function find_patiente($id){
        return $this->prepare_sql("SELECT * FROM patientes WHERE id = ?", [$id], fetchOne:true, fetchMode:PDO::FETCH_OBJ);
    }
    /**
     * Recupère les informations de l'adresse d'une patiente à partir de son id
     * @param int $id L'identifiant de la patient
     * @return array
     */
    public function adresse_patiente($id){
        return $this->prepare_sql("SELECT * FROM adresses WHERE patient_id = ?", [$id], fetchOne:true, fetchMode:PDO::FETCH_OBJ);
    }
    

}