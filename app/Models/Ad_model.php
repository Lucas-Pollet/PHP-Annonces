<?php

namespace App\Models;
use CodeIgniter\Model;

class Ad_model extends Model
{
    protected $table = 'T_annonce';

    public function getAd($id){
        $query = $this->db->query('SELECT A_idannonce, A_titre FROM T_annonce LIMIT 1');

        $row = $query->getResultArray();

        return $row;
    }

}