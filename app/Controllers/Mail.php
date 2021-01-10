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
        $config['mailType'] = 'html';

        $email->initialize($config);

        return $email;
    }

    public function sendTokenByMail($token, $dest){
        $message='Bonjour, <br>';
        $message.='Une demande pour récupérer votre compte a été demandé<br>';
        $message.='Pour le récupérer, entrez le code suivant sur le site: <br>';
        $message.='<b>'.$token.'</b>';

        return $this->sendMail('Reset de mot de passe', $message, $dest);

    }

    public function messageAdmin($mess, $dest){
        $message='Message de admin<br>';
        $message.='<b>'.$mess.'</b>';

        return $this->sendMail('Message ADMIN', $message, $dest);
    }

    public function decisionAdmin($mess, $dest){
        $message='-> Décision de l\'admin du site<br>';
        $message.='<b>'.$mess.'</b>';

        return $this->sendMail('Décision ADMIN', $message, $dest);

    }

    public function sendMail($subject, $message, $dest)
    {
        $email = $this->config();
        $email->setFrom('immodanslafrance@gmail.com', 'Site Annonces immobilières');
        $email->setTo($dest);
        $email->setSubject($subject);
        $email->setMessage($message);
        $email->send();

        if(!$email->send(false)){
            // echo $email->printDebugger();
            echo "Une erreur est survenu dans l'envoie du mail.";
        }
    }


}