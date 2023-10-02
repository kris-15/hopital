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

    public function recuperer_info($table){
        return $this->prepare_sql("SELECT * FROM $table", [], fetch:true,fetchMode:PDO::FETCH_OBJ);
    }
}