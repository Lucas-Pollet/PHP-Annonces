<?php


namespace App\Controllers;


class Logout extends BaseController
{
    public function index()
    {
        session_start();
        if(isset($_SESSION['login'])){
            unset($_SESSION['login']);
            return redirect()->to(base_url().'/public/');
        }
    }
}