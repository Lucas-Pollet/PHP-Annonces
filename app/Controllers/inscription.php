<?php
namespace App\Controllers;

use App\Models\Uti_model;

class inscription extends BaseController
{
    public function index()
    {

        if($this->request->getMethod() === 'post'){
            $model = new Uti_model();

            $email = $this->request->getVar('user_email');
            $login = $this->request->getVar('user_login');
            $prenom = $this->request->getVar('user_prename');
            $nom = $this->request->getVar('user_name');
            $pwdconfirm = $this->request->getVar('user_confirm');
            $pwd = $this->request->getVar('user_pwd');

            if($pwd != $pwdconfirm){
                $info = ['erreur' => 'Les mots de passe ne correspondent pas !'];
                return view('inscription', $info);
            }

            if($model->getMail($email) != null){
                $info = ['erreur' => 'Cet email est déjà existant !'];
                return view('inscription', $info);
            }

            if($model->getLogin($login) != null){
                $info = ['erreur' => 'Ce login est déjà existant !'];
                return view('inscription', $info);
            }

            $model->save([
                    'U_mail' => $email,
                    'U_mdp' => crypt($pwd, 'pwd_key'),
                    'U_pseudo' => $login,
                    'U_nom' => $nom,
                    'U_prenom' => $prenom
                ]);

            $mail_syst = new Mail();
            $mail_syst->sendMail("Compte créé avec succès", "Bienvenue ".$login." sur le site d'annonces immobilières !", $email);

            return redirect()->to('connexion/success');
        }else{
            echo view('inscription');
        }
    }

}