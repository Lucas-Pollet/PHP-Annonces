<?php


namespace App\Controllers;

use App\Models\Ad_model;

class Ad extends BaseController
{
    public function show($id){
        $model = new Ad_model();

        $data = $model->getAd($id);

        return view('ad', $data);
    }
}