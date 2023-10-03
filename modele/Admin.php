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

    public function modifier_statut_compte_medecin($statut, $id){
        return $this->prepare_sql("UPDATE medecins SET statut_compte=? WHERE id=?", [$statut, $id]);
    }
}