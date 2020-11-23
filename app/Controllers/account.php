<?php


namespace App\Controllers;

use App\Models\Uti_model;

class account extends BaseController
{
    public function index(){
        session_start();

        if(!(isset($_SESSION['login']))) {
            return redirect()->to('/public/');
        }else{
            $model = new Uti_model();
            $data = $model->getMail($_SESSION['login']);

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

    public function modifpwd(){
        $data['modifpwd']=1;

        if($this->request->getMethod() === 'post') {
            session_start();
            $model = new Uti_model();
            $mdp = $this->request->getVar('user_pwd');
            $confirm = $this->request->getVar('user_confirm');

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