<?php

namespace App\Models;
use CodeIgniter\Model;

class Ad_model extends Model
{
    protected $table = 'T_annonce';
    protected $allowedFields = ['A_idannonce', 'A_titre', 'A_cout_loyer', 'A_cout_charges', 'A_type_chauffage', 'A_superficie', 'A_description', 'A_ville', 'A_CP', 'U_mail'];

    public function getListAd(){
        return $this->findAll();
    }

    public function insert_ad($titre, $loyer, $charges, $chauffage, $superficie, $desc, $ville, $cp){
        $sql = "INSERT INTO `t_annonce` (`A_idannonce`, `A_titre`, `A_cout_loyer`, `A_cout_charges`, `A_type_chauffage`, `A_superficie`, `A_description`, `A_ville`, `A_CP`, `A_state`, `A_date`, `U_mail`, `T_type`, `P_idphoto`, `E_id_engie`) 
                VALUES (NULL, ?, ?, ?, ?, ?, ?, ?, ?, '1', '', ?, 'appart', '1', '1');";

        $this->db->query($sql, [$titre, $loyer, $charges, $chauffage, $superficie, $desc, $ville, $cp, $_SESSION['login']]);
    }

    public function update_ad($id=null, $titre, $loyer, $charges, $chauffage, $superficie, $desc, $ville, $cp){
        $sql = "UPDATE `t_annonce` 
                SET A_titre=?, A_cout_loyer=?, A_cout_charges=?, A_type_chauffage=?, A_superficie=?, A_description=?, A_ville=?, A_CP=?
                WHERE A_idannonce=?";

        $this->db->query($sql, [$titre, $loyer, $charges, $chauffage, $superficie, $desc, $ville, $cp, $id]);
    }

    public function publish_ad($id=null){
        $sql = "UPDATE `t_annonce` 
                SET A_state=2, A_date=now()
                WHERE A_idannonce=?";

        $this->db->query($sql, $id);
    }

    public function getPhotoByID($id){
        $sql = 'SELECT P_nom FROM t_photo JOIN t_annonce using(P_idphoto) WHERE A_idannonce= ?';
        $query = $this->db->query($sql, $id);

        return $query->getRow()->P_nom;
    }

    public function getAd($id){
        return $this->asArray()
            ->where(['A_idannonce' => $id])
            ->first();
    }

    public function getLastID($mail){
        $sql = 'SELECT A_idannonce FROM `t_annonce` WHERE U_mail=? ORDER BY 1 desc LIMIT 1';
        $query = $this->db->query($sql, $mail);
        $row = $query->getRow();

        return $row->A_idannonce;
    }

    public function getPersonalAd($mail){
        $sql = 'SELECT * FROM t_annonce WHERE U_mail=?';
        $query = $this->db->query($sql, $mail);

        return $query->getResultArray();
    }

    public function getNumberOfAd(){
        $query = $this->db->query('SELECT COUNT(A_idannonce) as "nb" FROM T_annonce');

        $row = $query->getRow();
        return $row->nb;
    }

}