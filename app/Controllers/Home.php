<?php namespace App\Controllers;

use App\Models\Ad_model;

class Home extends BaseController
{
	public function index()
	{
        $db = \Config\Database::connect();

	    $model = new Ad_model();

	    $data['ad'] = $model->getAd(1);
        $data['nbad'] = $model->getNumberOfAd();

        $data['listad'] = $model->getListAd();

		echo view('base', $data);
	}

	//--------------------------------------------------------------------

}
