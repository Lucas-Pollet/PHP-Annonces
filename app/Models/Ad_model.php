<?php

namespace App\Models;
use CodeIgniter\Model;

class Ad_model extends Model
{
    protected $table = 'T_annonce';
    protected $allowedFields = ['A_idannonce', 'A_titre', 'A_cout_loyer', 'A_type_chauffage', 'A_superficie', 'A_description', 'A_ville', 'A_CP'];

    public function getListAd(){
        return $this->findAll();
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

    public function getNumberOfAd(){
        $query = $this->db->query('SELECT COUNT(A_idannonce) as "nb" FROM T_annonce');

        $row = $query->getRow();
        return $row->nb;
    }

}