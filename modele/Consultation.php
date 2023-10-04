<?php
class Consultation extends Model{
    public function get_consultations(){
        return $this->prepare_sql(
            "SELECT *, consultations.id as id_consultation, medecins.id as id_medecin, medecins.nom as nom_medecin, 
            date_format(date_consultation, '%d/%m/%Y à %H:%i') as date_formatee, patientes.nom as nom_patiente, patientes.prenom as prenom_patiente 
            FROM consultations 
            INNER JOIN medecins ON medecins.id = consultations.medecin_id
            INNER JOIN patientes ON patientes.id = consultations.patient_id
             ORDER BY consultations.id DESC", 
            [], fetch:true, fetchMode:PDO::FETCH_OBJ
        );
    }
}