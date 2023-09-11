<?php
require '../modele/Modele.php';
class Medecin extends Model{
    public $id;
    public $nom;
    public $prenom;
    public $telephone;
    public $code;
    public $dateNais;
    public $epoux;
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
        $ajoutAdresse = $this->ajouter_adresse($infoAdressePatiente);
        return $ajoutAdresse;
    }

    private function patient_enregistre(array $infoPatiente){
        $sql = "SELECT id FROM patientes WHERE nom = ? AND prenom = ? AND telephone = ? AND code = ? AND date_naissance = ? AND epoux = ?";
        $patiente = $this->prepare_sql($sql, $infoPatiente, fetchOne: true, fetchMode: PDO::FETCH_OBJ);
        return $patiente;
    }

    private function ajouter_adresse(array $infoAdresse){
        $sql = "INSERT INTO adresses VALUE (null,?,?,?,?,?)";
        $ajout = $this->prepare_sql($sql, $infoAdresse);
        return $ajout;
    }

    /**
     * Permet de vérifier si le code a déjà été utilisé
     * @param string $code Le code à vérifier
     * @return int $reponse Le nombre des fois que le code a été utilisé
     */
    public function verifier_code($code){
        $reponse = $this->prepare_sql("SELECT count(id) FROM patientes WHERE code = ?", [$code], fetchColumn:true);
        return $reponse;
    }

    /**
     * Permet de récupérer tous les patientes enregistrées
     * @return array $lesPatientes La liste des patientes
     */
    // public function get_patientes(){
    //     $lesPatientes = $this->prepare_sql("SELECT * FROM patientes", [], fetch: true, fetchMode: PDO::FETCH_OBJ);
    //     return $lesPatientes;
    // }

    // public function get_patientes_by_nom($nomPatiente){
    //     $lesPatientes = $this->prepare_sql("SELECT * FROM patientes WHERE nom LIKE ?", ["%$nomPatiente%"], fetch: true, fetchMode: PDO::FETCH_OBJ);
    //     return $lesPatientes;
    // }

}