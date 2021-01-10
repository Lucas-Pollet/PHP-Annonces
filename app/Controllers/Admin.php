<?php


namespace App\Controllers;


use App\Models\Ad_model;
use App\Models\Messages_model;
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
        $model = new Uti_model();

        if($this->request->getMethod() === 'post'){
            $pseudo = $this->request->getVar('pseudo');
            $prenom = $this->request->getVar('prename');
            $nom = $this->request->getVar('name');
            $mail = $this->request->getVar('id');

            $uti = $model->getMail($mail);

            $model->replacePseudo($uti['U_pseudo'], $pseudo);
            $model->replaceName($mail, $prenom, $nom);

            $email = new Mail();
            $email->decisionAdmin('L\'admin du site a modifié votre profil !', $mail);

            $data['success'] = "Le profil de ".$mail." a été modifié avec succès !";
            return view('admin', $data);
        }

        if($id != null){
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
            $mail = new Mail();
            $mail->decisionAdmin('L\'admin a décidé de supprimer votre compte !', $id);

            $model->delAccount($id);
            $data['success'] = "Le compte de ".$id." a été supprimé avec succès !";

            return view("admin", $data);
        }
    }

    public function blockad($id=null){
        $model = new Uti_model();

        if($id != null){
            $mail = new Mail();
            $mail->decisionAdmin('L\'admin a décidé de bloquer vos annonces !', $id);

            $model->blockAd($id);
            $data['success'] = "Les annonces de ".$id." ont été bloquer avec succès !";

            return view("admin", $data);
        }
    }

    public function archive_ad($id){
        if($id != null){
            $model = new Ad_model();
            $model->archive_ad($id);

            $data['success'] = "L'annonce a été archivé avec succès !";
            return view("admin", $data);
        }
    }

    public function del_message($id){
        if($id != null){
            $model = new Messages_model();
            $model->deleteAllMessages($id);

            $data['success'] = "Les messages ont été supprimés avec succès !";
            return view("admin", $data);
        }
    }

    public function del_ad($id){
        if($id != null){
            $model = new Ad_model();
            $model->delete_ad($id);

            $data['success'] = "L'annonce a été supprimé avec succès !";
            return view("admin", $data);
        }
    }


}