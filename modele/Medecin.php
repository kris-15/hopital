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
        return $this->ajouter_adresse($infoAdressePatiente);
    }

    private function patient_enregistre(array $infoPatiente){
        $sql = "SELECT id FROM patientes WHERE nom = ? AND prenom = ? AND telephone = ? AND code = ? AND date_naissance = ? AND epoux = ?";
        return $this->prepare_sql($sql, $infoPatiente, fetchOne: true, fetchMode: PDO::FETCH_OBJ);
    }

    private function ajouter_adresse(array $infoAdresse){
        $sql = "INSERT INTO adresses VALUE (null,?,?,?,?,?)";
        return $this->prepare_sql($sql, $infoAdresse);
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
     * Permet d'enregistrer un nouvel enfant
     * @param array $infoEnfant Les données de l'enfant
     * @return bool
     */
    public function enregistrer_enfant(array $infoEnfant){
        $enregistrement = $this->prepare_sql("INSERT INTO enfants VALUES (null,?,?,?,?,?,?,?,?,?,?,?)", $infoEnfant);
        return $this->id_enfant($infoEnfant);
    }

    public function check_enfants(array $infoEnfant){
        return $this->prepare_sql(
            "SELECT count(id) FROM enfants WHERE nom=? AND sexe=? AND poids=? AND 
            date_naissance=? AND taille=? AND apgar=? AND pc=? AND observation=? AND 
            parent_id=? AND medecin_id=? AND etat=?",
            $infoEnfant, fetchColumn:true
        );
        return $this->id_enfant($infoEnfant);
        
    }
    public function id_enfant(array $infoEnfant){
        return $this->prepare_sql(
            "SELECT id FROM enfants WHERE nom=? AND sexe=? AND poids=? AND 
            date_naissance=? AND taille=? AND apgar=? AND pc=? AND observation=? AND 
            parent_id=? AND medecin_id=? AND etat=?",
            $infoEnfant, fetchOne:true
        );
    }

    
    /**
     * Permet d'enregistrer un nouvel enfant
     * @param array $infoAccouchement Les données de l'enfant
     * @return bool
     */
    public function enregistrer_accouchement(array $infoAccouchement){
        return $this->prepare_sql("INSERT INTO accouchements VALUES (null,?,?,?,?,?,?,?,?)", $infoAccouchement);
    }

    //Consultation

    /**
     * Permet d'enregistrer une nouvelle consultation
     * @param array $infoConsultation Les information relatives à la consultation
     * @return bool
     */
    public function enregistrer_consultation(array $infoConsultation){
        return $this->prepare_sql("INSERT INTO consultations VALUE (null,?,?,?,?,?,?,NOW())", $infoConsultation);
    }

    /**
     * Permet de récupérer les consultations précédentes de la patiente
     * @param int $idPatiente L'identifiant de la patiente
     * @return array $consultation
     */
    public function consultation_patiente($idPatiente){
        return $this->prepare_sql(
            "SELECT *, consultations.id as id_consultation, medecins.id as id_medecin, medecins.nom as nom_medecin, 
            date_format(date_consultation, '%d/%m/%Y à %H:%i') as date_formatee 
            FROM consultations 
            INNER JOIN medecins ON medecins.id = consultations.medecin_id
            WHERE patient_id = ? ORDER BY consultations.id DESC", 
            [$idPatiente], fetch:true, fetchMode:PDO::FETCH_OBJ
        );
    }
    public function consultations(){
        $consultation = new Consultation();
        return $consultation->get_consultations();
    }
    public function liste_enfants(){
        return $this->prepare_sql(
            "SELECT *, enfants.id as id_enfant, enfants.nom as nom_enfant,medecins.id as id_medecin,
            medecins.nom as nom_medecin, date_format(enfants.date_naissance, '%d/%m/%Y') as date_formatee, 
            patientes.nom as nom_mamam, patientes.prenom as prenom_maman, patientes.epoux as papa FROM enfants 
            INNER JOIN medecins ON medecins.id = enfants.medecin_id
            INNER JOIN patientes ON patientes.id = enfants.parent_id
             ORDER BY enfants.id DESC", 
            [], fetch:true, fetchMode:PDO::FETCH_OBJ
        );
    }

}