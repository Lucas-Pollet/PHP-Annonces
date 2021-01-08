<?php


namespace App\Controllers;


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

    public function liste_ad(){

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