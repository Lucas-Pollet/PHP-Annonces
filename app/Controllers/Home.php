<?php namespace App\Controllers;

use App\Models\Ad_model;

class Home extends BaseController
{
	public function index()
	{
        $model = new Ad_model();

        $data['nbad'] = $model->getNumberOfAd();
        $data['listad'] = $model->getListAdHome();

		return view('base', $data);
	}
}
