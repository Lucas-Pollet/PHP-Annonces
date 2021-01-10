<?php

namespace App\Controllers;

use App\Models\Uti_model;

class connexion extends BaseController
{
    public function index(){
        if($this->request->getMethod() === 'post'){
            $model = new Uti_model();

            $email = $this->request->getVar('user_email');
            $pwd = $this->request->getVar('user_pwd');

            if($model->getMail($email) == null){
                $info = ['erreur' => 'Cet email est inconnu !'];
                return view('connexion', $info);
            }
            $crypted_pwd = crypt($pwd, 'pwd_key');
            $data = $model->getMail($email);

            if($data['U_mdp'] != $crypted_pwd){
                $info = ['erreur' => 'Mot de passe incorrecte !'];
                return view('connexion', $info);
            }

            echo "Succès";
            session_start();
            $_SESSION['login']=$email;

            return redirect()->to(base_url().'/public');
        }else{
            echo view('connexion');
        }

    }
}