<?php


namespace App\Controllers;

use App\Models\Ad_model;
use App\Models\Messages_model;
use App\Models\Uti_model;

class account extends BaseController
{
    public function index(){
        session_start();

        if(!(isset($_SESSION['login']))) {
            return redirect()->to('/public/');
        }else{
            $model = new Uti_model();
            $data['account'] = $model->getMail($_SESSION['login']);

            return view('account', $data);
        }
    }

    public function myad(){
        session_start();

        if(!(isset($_SESSION['login']))) {
            return redirect()->to('/public/');
        }else {
            $mod_ad = new Ad_model();
            $data['ad_data'] = $mod_ad->getPersonalAd($_SESSION['login']);
            $data['archive_ad_data'] = $mod_ad->getArchivedAd($_SESSION['login']);

            return view('account', $data);
        }
    }

    public function messages(){
        session_start();

        if(!(isset($_SESSION['login']))) {
            return redirect()->to('/public/');
        }else {
            $mess_mod = new Messages_model();

            $listad = $mess_mod->getAllConversation($_SESSION['login']);

            $test = array();
            foreach ($listad as $row){
                if($row['U_receiver'] == $_SESSION['login']){
                        $array = array('info' => $row['U_mail'], 'idad' => $row['A_idannonce']);
                        array_push($test, $array);
                }
                if($row['U_mail'] == $_SESSION['login']){
                        $array = array('info' => $row['U_receiver'], 'idad' => $row['A_idannonce']);
                        array_push($test, $array);
                }
                //$array = array('infoad' => $mess_mod->getAllConversation($row['A_idannonce']), 'idad' => $row['A_idannonce']);

            }

            $data['list_conv']  = $test;
            $data['messages'] = 1;

            return view('account', $data);
        }
    }

    public function modifnom(){
        $data['modifnom']=1;

        if($this->request->getMethod() === 'post') {
            session_start();
            $model = new Uti_model();

            $prename = $this->request->getVar('user_prename');
            $name = $this->request->getVar('user_name');

            $model->replaceName($_SESSION['login'], $prename, $name);

            return redirect()->to("/public/account");
        }

        return view('modifpage', $data);

    }
/*
    public function modifmail(){
        $data['modifmail']=1;

        if($this->request->getMethod() === 'post') {
            session_start();
            $model = new Uti_model();
            $email = $this->request->getVar('user_email');

            if($model->getMail($email) != null){
                $data['erreur'] = 'Cet email est déjà existant !';
                return view('modifpage', $data);
            }

            $model->replaceMail($_SESSION['login'], $email);
            $_SESSION['login']=$email;

            return redirect()->to("/public/account");
        }

        return view('modifpage', $data);
    }
*/
    public function modifpseudo(){
        $data['modifpseudo']=1;

        if($this->request->getMethod() === 'post') {
            session_start();
            $model = new Uti_model();
            $pseudo = $this->request->getVar('user_pseudo');

            if($model->getLogin($pseudo) != null){
                $data['erreur'] = 'Ce pseudo est déjà existant !';
                return view('modifpage', $data);
            }

            $profil = $model->getMail($_SESSION['login']);

            $model->replacePseudo($profil['U_pseudo'], $pseudo);

            return redirect()->to("/public/account");
        }

        return view('modifpage', $data);
    }

    public function modifpwd(){
        $data['modifpwd']=1;

        if($this->request->getMethod() === 'post') {
            session_start();
            $model = new Uti_model();

            $oldpwd = $this->request->getVar('user_oldpwd');
            $mdp = $this->request->getVar('user_pwd');
            $confirm = $this->request->getVar('user_confirm');

            $crypted_pwd = crypt($oldpwd, 'pwd_key');
            $user = $model->getMail($_SESSION['login']);

            if($user['U_mdp'] != $crypted_pwd){
                $data['erreur'] = 'Ancien mot de passe incorrecte !';
                return view('modifpage', $data);
            }

            if($mdp != $confirm){
                $data['erreur'] = 'Les mots de passe ne correspondent pas !';
                return view('modifpage', $data);
            }

            $model->replacePwd($_SESSION['login'], $mdp);
            return redirect()->to("/public/account");
        }


        return view('modifpage', $data);
    }
    public function delaccount(){
        $data['delaccount']=1;

        if($this->request->getMethod() === 'post') {
            session_start();
            $model = new Uti_model();

            $model->delAccount($_SESSION['login']);
            unset($_SESSION['login']);

            return redirect()->to('/public');
        }


        return view('modifpage', $data);
    }

}