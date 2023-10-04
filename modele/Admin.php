<?php 
require_once 'Modele.php';
class Admin extends Model{
    public string $login;
    public string $mdp;
    public function __construct($login,$mdp)
    {
        $this->login = $login;
        $this->mdp = $mdp;
    }
    public function connexion(){
        return $this->prepare_sql("SELECT * FROM admins WHERE login=? AND password=?",[$this->login, $this->mdp], fetchOne:true, fetchMode:PDO::FETCH_OBJ);
    }

    /**
     * Cette méthode permet à l'admin de récupérer les infos dans une table précise
     * @param string $table Le nom de la table à cibler
     * @return array||null
     */
    public function recuperer_info($table){
        return $this->prepare_sql("SELECT * FROM $table", [], fetch:true,fetchMode:PDO::FETCH_OBJ);
    }

    /**
     * Permet à l'admin de récupérer les informations sur base une recherche
     * @param string $table Le nom de la table
     * @param string $champ Le nom du champ ciblé
     * @param string $valeur La valeur entrée
     * @return array||bool
     */
    public function recherche_info($table, $champ, $valeur){
        return $this->prepare_sql("SELECT * FROM $table WHERE $champ LIKE ?", ["%$valeur%"], fetch: true, fetchMode: PDO::FETCH_OBJ);
    }

    /**
     * Permet à l'admin de récupérer les informations dans une table à partir de l'id
     * @param string $table Le nom de la table
     * @param int $id Id ciblé
     */
    public function recuperer_par_id($table,$id){
        return $this->prepare_sql("SELECT * FROM $table WHERE id=?", [$id], fetchOne: true, fetchMode: PDO::FETCH_OBJ);
    }

    /**
     * Permet l'administrateur soit d'activer soit de desactiver un compte médecin;
     */
    public function modifier_statut_compte_medecin($statut, $id){
        return $this->prepare_sql("UPDATE medecins SET statut_compte=? WHERE id=?", [$statut, $id]);
    }

    /**
     * Permet à l'admin d'ajouter un receptionniste
     * @param string $nom Le nom de la personne
     * @param string $prenom Le prenom de la personne
     * @param string $telephone Le numéro de téléphone de la personne
     * @param string $code Le code généré de la personne
     * @return bool
     */
    public function ajouter_receptionniste($nom,$prenom,$telephone,$code){
        return $this->prepare_sql("INSERT INTO receptionnistes VALUE(null,?,?,?,?)", [$nom,$prenom,$telephone,$code]);
    }

    /**
     * Permet à l'admin de modifier les info d'un receptionniste à l'inception du code
     * @param int $idRec Id du receptionniste
     * @param string $nom Le nom du receptionniste 
     * @param string $prenom Le prenom du receptionniste 
     * @param string $telephone Le numéro de téléphone du receptionniste 
     */
    public function modifier_info_receptionniste($idRec, $nom,$prenom,$telephone){
        return $this->prepare_sql("UPDATE receptionnistes SET nom=?, prenom=?, telephone=? WHERE id=?", [$nom,$prenom,$telephone, $idRec]);
    }
    /**
     * Permet à l'admin de supprimer une ligne dans une table
     * @param string $table Le nom de la table
     * @param int $id Id de la ligne
     * @return bool
     */
    public function supprimer_par_id($table,$id){
        return $this->prepare_sql("DELETE FROM $table WHERE id=?",[$id]);
    }
    public function liste_consultations(){
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