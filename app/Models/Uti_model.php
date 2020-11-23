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

    public function replaceMail($oldmail, $newmail){
        $this->set('U_mail', $newmail);
        $this->where('U_mail', $oldmail);
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

    public function delAccount($mail){
        $this->where('U_mail', $mail);
        $this->delete();
    }

}