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

    public function getListAdHome(){
        $sql = 'SELECT * FROM `t_annonce` ORDER BY A_date desc LIMIT 6';
        $query = $this->db->query($sql);

        return $query->getResultArray();
    }

    public function getListForPage($first, $nb){
        $sql = 'SELECT * FROM `t_annonce` ORDER BY A_date desc LIMIT ?, ?';
        $query = $this->db->query($sql, [$first, $nb]);

        return $query->getResultArray();
    }

    public function insert_ad($titre, $loyer, $charges, $chauffage, $superficie, $desc, $ville, $cp){
        $sql = "INSERT INTO `t_annonce` (`A_idannonce`, `A_titre`, `A_cout_loyer`, `A_cout_charges`, `A_type_chauffage`, `A_superficie`, `A_description`, `A_ville`, `A_CP`, `A_state`, `A_date`, `U_mail`, `T_type`, `E_id_engie`) 
                VALUES (NULL, ?, ?, ?, ?, ?, ?, ?, ?, '1', '', ?, 'appart', '1');";

        $this->db->query($sql, [$titre, $loyer, $charges, $chauffage, $superficie, $desc, $ville, $cp, $_SESSION['login']]);
    }

    public function update_ad($id, $titre, $loyer, $charges, $chauffage, $superficie, $desc, $ville, $cp){
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

    public function archive_ad($id=null){
        $sql = "UPDATE `t_annonce` 
                SET A_state=3
                WHERE A_idannonce=?";

        $this->db->query($sql, $id);
    }

    public function delete_ad($id=null){
        $sql = "DELETE FROM `t_annonce` 
                WHERE A_idannonce=?";

        $this->db->query($sql, $id);
    }

    public function addPhoto($name, $path, $id){
        $sql = "INSERT INTO `t_photo` (`P_idphoto`, `P_titre`, `P_nom`, `A_idannonce`) VALUES (NULL, ?, ?, ?)";

        $this->db->query($sql, [$name, $path, $id]);
    }

    public function removePhoto($id){
        $sql = "DELETE FROM `t_photo` WHERE A_idannonce=?";

        $this->db->query($sql, $id);
    }

    public function getALLphoto($id){
        $sql = 'SELECT * FROM `t_photo` WHERE A_idannonce=?';
        $query = $this->db->query($sql, $id);

        return $query->getResultArray();
    }

    public function getPhotoByID($id){
        $sql = 'SELECT P_nom FROM t_photo WHERE A_idannonce= ? LIMIT 0,1';
        $query = $this->db->query($sql, $id);

        return $query->getRow()->P_nom;
    }

    public function getAd($id){
        return $this->asArray()
            ->where(['A_idannonce' => $id])
            ->first();
    }

    public function getTitleAd($id){
        $sql = "SELECT A_titre FROM t_annonce WHERE A_idannonce=?";

        $query = $this->db->query($sql, $id);
        $row = $query->getRow();

        return $row->A_titre;
    }

    public function getDate($id){
        $sql = "SELECT DATE_FORMAT(A_date, '%d/%m/%y') as 'date' FROM t_annonce WHERE A_idannonce=?";

        $query = $this->db->query($sql, $id);
        $row = $query->getRow();

        return $row->date;
    }

    public function getState($id){
        $sql = "SELECT A_state FROM t_annonce WHERE A_idannonce=?";

        $query = $this->db->query($sql, $id);
        $row = $query->getRow();

        return $row->A_state;
    }

    public function getLastID($mail){
        $sql = 'SELECT A_idannonce FROM `t_annonce` WHERE U_mail=? ORDER BY 1 desc LIMIT 1';
        $query = $this->db->query($sql, $mail);
        $row = $query->getRow();

        return $row->A_idannonce;
    }

    public function getPersonalAd($mail){
        $sql = 'SELECT * FROM t_annonce WHERE U_mail=? AND A_state!=3';
        $query = $this->db->query($sql, $mail);

        return $query->getResultArray();
    }

    public function getArchivedAd($mail){
        $sql = 'SELECT * FROM t_annonce WHERE U_mail=? AND A_state=3';
        $query = $this->db->query($sql, $mail);

        return $query->getResultArray();
    }

    public function getNumberOfPersonalAd($mail){
        $sql = 'SELECT COUNT(A_idannonce) as "nb" FROM t_annonce WHERE U_mail=? AND A_state!=3';
        $query = $this->db->query($sql, $mail);

        $row = $query->getRow();

        return $row->nb;
    }

    public function getNumberOfArchivedAd($mail){
        $sql = 'SELECT COUNT(A_idannonce) as "nb" FROM t_annonce WHERE U_mail=? AND A_state=3';
        $query = $this->db->query($sql, $mail);

        $row = $query->getRow();

        return $row->nb;
    }

    public function getNumberOfAd(){
        $query = $this->db->query('SELECT COUNT(A_idannonce) as "nb" FROM T_annonce WHERE A_state=2');

        $row = $query->getRow();
        return $row->nb;
    }

}