<?php

namespace App\Controllers;

class Mail extends BaseController
{

    public function config()
    {
        $email = \Config\Services::email();

        $config['protocol'] = 'smtp';
        $config['SMTPHost'] = 'ssl://smtp.gmail.com';
        $config['SMTPUser'] = 'immodanslafrance@gmail.com';
        $config['SMTPPass'] = 'Yt75bVrZ5';
        $config['SMTPPort'] = 465;

        $email->initialize($config);

        return $email;
    }

    public function index()
    {
        $dest = 'lucaspol@hotmail.fr';

        $this->sendMail('Bonjour ceci est un test', "Ceci est le contenu", $dest);
    }

    public function sendMail($subject, $message, $dest)
    {
        $email = $this->config();
        $email->setFrom('immodanslafrance@gmail.com', 'Site Annonces immobilières');
        $email->setTo($dest);
        $email->setSubject($subject);
        $email->setMessage($message);
        $email->send();

        if($email->send(true)){
            echo "Mail envoyé !";
        }else{
            echo "Erreur";
        }
    }


}