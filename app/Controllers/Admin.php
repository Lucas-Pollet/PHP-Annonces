<?php


namespace App\Controllers;


use App\Models\Ad_model;
use App\Models\Uti_model;

class Admin extends BaseController
{

    public function index(){
        session_start();
        if(isset($_SESSION['login'])){
            $uti_mod = new \App\Models\Uti_model();
            $info_uti = $uti_mod->getMail($_SESSION['login']);

            if($uti_mod->getAdmin($info_uti['U_pseudo']) == 1){
                    return view("admin");
            }
        }
    }

    public function listeuti(){
        $model = new Uti_model();

        $data['users'] = $model->getAllUti();

        return view("admin", $data);

    }

    public function listead(){
        $model = new Ad_model();

        $data['listead'] = $model->getListAd();

        return view("admin", $data);

    }

    public function editprofil($id=null){
        if($id != null){
            $model = new Uti_model();
            $data['account'] = $model->getMail($id);

            return view("admin", $data);
        }
    }

    public function sendmail($id=null){
        if($this->request->getMethod() === 'post'){
            $message = $this->request->getVar('message');
            $mail = $this->request->getVar('mail');

            $email = new Mail();
            $email->messageAdmin($message, $mail);

            $data['success'] = "Email envoyé avec succès !";

            return view('admin', $data);
        }

        if($id != null){

            $data['message'] = 1;
            $data['mail'] = $id;

            return view("admin", $data);

        }
    }

    public function delaccount($id=null){
        $model = new Uti_model();

        if($id != null){
            $model->delAccount($id);
            $data['success'] = "Le compte de ".$id." a été supprimé avec succès !";

            return view("admin", $data);
        }
    }

    public function blockad($id=null){
        $model = new Uti_model();

        if($id != null){
            $model->blockAd($id);
            $data['success'] = "Les annonces de ".$id." ont été bloquer avec succès !";

            return view("admin", $data);
        }

    }



}