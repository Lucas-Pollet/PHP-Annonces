<?php


namespace App\Models;

use CodeIgniter\Model;


class Uti_model extends Model
{
    protected $table = 'T_utilisateur';
    protected $allowedFields = ['U_mail', 'U_mdp', 'U_pseudo', 'U_nom', 'U_prenom'];

    public function getMail($mail){
        return $this->asArray()
            ->where(['U_mail' => $mail])
            ->first();
    }

    public function getLogin($login){
        return $this->asArray()
            ->where(['U_pseudo' => $login])
            ->first();
    }

    public function getAdmin($login){
        $sql = 'SELECT role FROM t_admin WHERE U_pseudo=?';
        $query = $this->db->query($sql, $login);
        $row = $query->getRow();

        if(isset($row)){
            return $row->role;
        }
    }

    public function getAllUti(){
        $sql = 'SELECT * FROM T_utilisateur';
        $query = $this->query($sql);

        return $query->getResultArray();
    }

    public function replaceMail($oldmail, $newmail){
        $this->set('U_mail', $newmail);
        $this->where('U_mail', $oldmail);
        $this->update();
    }

    public function replacePseudo($oldpseudo, $newpseudo){
        $this->set('U_pseudo', $newpseudo);
        $this->where('U_pseudo', $oldpseudo);
        $this->update();
    }

    public function replaceName($mail, $prename, $name){
        $this->set('U_prenom', $prename);
        $this->set('U_nom', $name);
        $this->where('U_mail', $mail);
        $this->update();
    }

    public function replacePwd($mail, $mdp){
        $this->set('U_mdp', crypt($mdp, 'pwd_key'));
        $this->where('U_mail', $mail);
        $this->update();
    }

    public function blockAd($mail){
        $sql = 'UPDATE `t_annonce` SET `A_state`=3 WHERE U_mail=?';
        $this->query($sql, $mail);
    }

    public function delAccount($mail){
        $sql = 'DELETE FROM t_message WHERE U_mail = ? OR U_receiver = ?';
        $this->query($sql, [$mail, $mail]);
        $sql2 = 'DELETE FROM t_annonce WHERE U_mail = ?';
        $this->query($sql2, $mail);

        $this->where('U_mail', $mail);
        $this->delete();
    }

}