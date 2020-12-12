<?php


namespace App\Controllers;

use App\Models\Ad_model;

class Ad extends BaseController
{
    // Visualisation d'une annonce
    public function show($id){
        $model = new Ad_model();

        $data = $model->getAd($id);

        return view('ad', $data);
    }

    // création d'une annonce
    public function create($id=null){
        session_start();
        if(isset($_SESSION['login'])){
            if($this->request->getMethod() === 'post'){
                $title = $this->request->getVar('title');
                $loyer = $this->request->getVar('loyer');
                $charges = $this->request->getVar('charges');
                $loc_cp = $this->request->getVar('loc_cp');
                $loc_ville = $this->request->getVar('loc_ville');
                $chauffage = $this->request->getVar('chauffage');
                $locsize = $this->request->getVar('locsize');
                $desc = $this->request->getVar('desc');

                $model = new Ad_model();

                // just save
                if(isset($_POST['save'])){
                    $model->insert_ad($title, $loyer, $charges, $chauffage, $locsize, $desc, $loc_ville, $loc_cp);

                // save and publish
                }else if(isset($_POST['publish'])){
                    $model->insert_ad($title, $loyer, $charges, $chauffage, $locsize, $desc, $loc_ville, $loc_cp);
                    $model->publish_ad($model->getLastID($_SESSION['login']));
                }

                return redirect()->to('/public/account/myad');
            }else{
                return view('create_ad');
            }
        }else{
            return redirect()->to('/public/');
        }
    }

    // édition d'une annonce
    public function edit($id=null){
        session_start();

        if(isset($_SESSION['login'])){
            $model = new Ad_model();

            // envoie de l'édition
            if($this->request->getMethod() === 'post') {
                $title = $this->request->getVar('title');
                $loyer = $this->request->getVar('loyer');
                $charges = $this->request->getVar('charges');
                $loc_cp = $this->request->getVar('loc_cp');
                $loc_ville = $this->request->getVar('loc_ville');
                $chauffage = $this->request->getVar('chauffage');
                $locsize = $this->request->getVar('locsize');
                $desc = $this->request->getVar('desc');

                $id_edit = $this->request->getVar('id');

                // just save
                if (isset($_POST['save'])) {
                    $model->update_ad($id_edit, $title, $loyer, $charges, $chauffage, $locsize, $desc, $loc_ville, $loc_cp);

                // save and publish
                } else if (isset($_POST['publish'])) {
                    $model->update_ad($id_edit, $title, $loyer, $charges, $chauffage, $locsize, $desc, $loc_ville, $loc_cp);
                    $model->publish_ad($id_edit);
                }

                return redirect()->to('/public/account/myad');
            }

            $data = $model->getAd($id);

            // Vérification si cette annonce appartient bien à son créateur
            if($data['U_mail'] == $_SESSION['login']){
                return view('edit_ad', $data);
            }else{
                return redirect()->to('/public/');
            }
        }else{
            return redirect()->to('/public/');
        }

    }

    public function archive($id=null){
        session_start();
        if(isset($_SESSION['login'])){
            $model = new Ad_model();
            $data = $model->getAd($id);

            // Vérification si cette annonce appartient bien à son créateur
            if($data['U_mail'] == $_SESSION['login']){
                $model->archive_ad($id);
                return redirect()->to('/public/account/myad');
            }else{
                return redirect()->to('/public/');
            }
        }else{
            return redirect()->to('/public/');
        }
    }

    // Suppression d'une annonce
    public function delete($id=null){
        session_start();
        if(isset($_SESSION['login'])){
            $model = new Ad_model();
            $data = $model->getAd($id);

            // Vérification si cette annonce appartient bien à son créateur
            if($data['U_mail'] == $_SESSION['login']){
                $model->delete_ad($id);
                return redirect()->to('/public/account/myad');
            }else{
                return redirect()->to('/public/');
            }
        }else{
            return redirect()->to('/public/');
        }
    }

}