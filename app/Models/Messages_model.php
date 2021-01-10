<?php

namespace App\Models;
use CodeIgniter\Model;

class Messages_model extends Model
{
    protected $table = 't_message';

    public function insert_message($mail, $receiver, $id_ad, $text){
        $sql = "INSERT INTO `t_message` (`M_date`, `M_texte`, `U_mail`, `U_receiver`, `A_idannonce`) VALUES (now(), ?, ?, ?, ?)";
        $this->db->query($sql, [$text, $mail, $receiver, $id_ad]);
    }

    public function getProprio($id_ad){
        $sql = "SELECT U_mail FROM `t_annonce` WHERE A_idannonce=?";
        $query = $this->db->query($sql, $id_ad);

        return $query->getRow()->U_mail;
    }

    public function getAllMessageConv($id_ad, $mail_demandeur){
        $sql = "SELECT * FROM `t_message` WHERE A_idannonce=? AND (U_mail=? OR U_mail=?) AND (U_receiver=? OR U_receiver=?)";
        $query = $this->db->query($sql, [$id_ad, $mail_demandeur, $this->getProprio($id_ad), $mail_demandeur, $this->getProprio($id_ad)]);

        return $query->getResultArray();
    }

    public function getPseudo($mail){
        $sql = "SELECT U_pseudo FROM `t_utilisateur` WHERE U_mail=?";
        $query = $this->db->query($sql, $mail);

        return $query->getRow()->U_pseudo;
    }

    public function getMailByPseudo($pseudo){
        $sql = "SELECT U_mail FROM `t_utilisateur` WHERE U_pseudo=?";
        $query = $this->db->query($sql, $pseudo);

        return $query->getRow()->U_mail;
    }

    public function getAllConversation($mail){
        $sql = "SELECT DISTINCT A_idannonce, U_mail, U_receiver FROM t_message WHERE U_mail=? OR U_receiver=?";
        $query = $this->db->query($sql, [$mail, $mail]);

        return $query->getResultArray();
    }

    public function deleteAllMessages($id){
        $sql = "DELETE FROM `t_message` 
                WHERE A_idannonce=?";

        $this->db->query($sql, $id);
    }

}