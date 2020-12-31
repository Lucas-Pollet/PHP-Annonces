<?php

namespace App\Controllers;

use App\Models\Ad_model;
use App\Models\Messages_model;

class Messages extends BaseController
{

    public function conv($id = null, $id_2 = null){
        session_start();

        if($this->request->getMethod() === 'post'){
            $model = new Messages_model();

            $text = $this->request->getVar('texte');
            $id_ad = $this->request->getVar('id');
            $id_asker = $this->request->getVar('id2');

            if(empty($text)){
                return redirect()->to('/public/messages/conv/'.$id_ad.'/'.$id_asker);
            }

            if($_SESSION['login'] == $model->getProprio($id_ad)){
                $model->insert_message($_SESSION['login'], $model->getMailByPseudo($id_asker), $id_ad, $text);
            }else{
                $model->insert_message($_SESSION['login'], $model->getProprio($id_ad), $id_ad, $text);
            }

            return redirect()->to('/public/messages/conv/'.$id_ad.'/'.$id_asker);
        }

        if($id == null || $id_2 == null){
            return redirect()->to('/public/');
        }

        $model = new Messages_model();
        $ad_model = new Ad_model();

        $recupad = $ad_model->getAd($id);
        $data['title_ad'] = $recupad['A_titre'];

        $data['proprio'] = $model->getPseudo($model->getProprio($id));
        // id correspond à l'id de l'annonce
        // id 2 correspond au pseudo du demandeur

        $mail_demandeur = $model->getMailByPseudo($id_2);

        $data['all_messages'] = $model->getAllMessageConv($id, $mail_demandeur);
        $data['id'] = $id;
        $data['id2'] = $id_2;

        return view('messages', $data);
    }

}