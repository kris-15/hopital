<?php
class Model{
    protected $pdo;
    public function get_pdo(){
        $this->pdo = new PDO("mysql:host=localhost;dbname=hopital;", 'root', '', 
            [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC]
        );
        return $this->pdo;
    }

    /**
     * Permet de faire une requête préparée
     * @param string $sql La requête SQL à exécuter
     * @param array $valeur La valeur à exécuter
     * @param bool $fetch Vérifie s'il faut rechercher des éléments ou juste une insertion
     * @param bool $fetchColumn si on va compter les rows existantes
     * @param bool $fetchOne si on va chercher qu'un seul élément
     * @return bool||array $donnees
     */
    public function prepare_sql(
        $sql, Array $valeurs, $fetch = false, $fetchColumn = false, 
        $fetchOne = false, $fetchMode = PDO::FETCH_ASSOC, 
    )
    {
        $requete = $this->get_pdo()->prepare($sql);
        $requete->execute($valeurs);
        $donnees = true;
        if($fetch){
            $donnees = $requete->fetchAll($fetchMode);
        }
        if($fetchColumn){
            $donnees = $requete->fetchColumn();
        }
        if($fetchOne){
            $donnees = $requete->fetch($fetchMode);
        }
        return $donnees;
    }
    /**
     * Retourne l'id d'une entrée dans une entité grace à un champ
     * @param string $champ Le champ de la table
     * @param string $table La table ciblée
     * @param string $valeur La valeur indexé
     */
    public function get_id_by($champ, $table, $valeur){
        return $this->prepare_sql("SELECT id FROM $table WHERE $champ= ?", [$valeur], fetchColumn:true);
    }
}