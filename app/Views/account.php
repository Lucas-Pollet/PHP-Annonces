<!doctype html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Annonces - Compte</title>
    <link rel="stylesheet" href="/css/ad.css">
</head>

<body>
<?php

require_once(APPPATH.'ThirdParty/smarty/Smarty.class.php');

$smarty = new Smarty();

$smarty->display(APPPATH . 'Views/connected_header.tpl');

$model = new \App\Models\Ad_model();
?>

</br>
<div class="container-card">

    <nav class="tabs-menu">
        <a href="/public/public/account/" class="tabs-menu-link">Mon compte</a>
        <a href="/public/account/myad" class="tabs-menu-link">Mes annonces</a>
        <a href="/public/account/messages" class="tabs-menu-link">Mes messages</a>
    </nav>

        <?php if(isset($account)): ?>
            <br>
            <h2><i class="fas fa-user-alt"></i> Profil</h2>
            <?php if(!empty($account['U_pseudo']) && !empty($account['U_prenom']) && !empty($account['U_nom']) && !empty($account['U_mail'])): ?>
            <h4>Votre pseudo: <?= $account['U_pseudo'] ?></h4>
            <h4>Votre nom: <?= $account['U_prenom']." ". $account['U_nom']?> <a href="/public/public/account/modifnom/"><button class="btn--info">Modifier</button></a></h4>
            <h4>Votre adresse email: <?= $account['U_mail'] ?> <a href="/public/public/account/modifmail/"><button class="btn--info">Modifier</button></a></h4><br>
            <a href="/public/public/account/modifpwd/"><button class="btn--info">Modifier mon mot de passe</button></a><br><br>
            <a href="/public/public/account/delaccount/"><button class="btn--warning">Supprimer mon compte</button></a>
            <?php endif ?>
        <?php elseif (isset($ad_data) || isset($archive_ad_data)): ?>
            <br>
             <a href="/public/ad/create" class="bar"><div class="btn--info"><i class="fas fa-plus-circle"></i>  Ajouter une annonce</div></a>

            <h3>Annonces publiés ou en rédaction</h3>
        <?php
            if($model->getNumberOfPersonalAd($_SESSION['login']) > 0):
                foreach ($ad_data as $row){ ?>
                    <div class="box-ad">
                        <p class="text-ad"><?= $row['A_titre'] ?> - <?php if($model->getState($row['A_idannonce']) == 1):  ?>Rédaction<?php else: ?> Publié le <?= $model->getDate($row['A_idannonce']) ?><?php endif ?>

                            <?php if($row['A_state'] == 2): ?>
                                <a href="/public/ad/show/<?= $row['A_idannonce'] ?>"><span class="ad-button greencolor"><i class="fas fa-eye"></i></span></a>
                            <?php endif ?>
                            <a href="/public/ad/edit/<?= $row['A_idannonce'] ?>" h><span class="ad-button yellowcolor"><i class="fas fa-edit"></i></span></a>

                            <?php if($row['A_state'] == 2): ?>
                                <a href="/public/ad/archive/<?= $row['A_idannonce'] ?>"><span class="ad-button browncolor"><i class="fas fa-archive"></i></span></a>
                            <?php elseif($row['A_state'] == 1): ?>
                                <a href="/public/ad/delete/<?= $row['A_idannonce'] ?>"><span class="ad-button redcolor"><i class="fas fa-trash"></i></span></a>
                            <?php endif; ?>
                        </p>
                    </div>

                    <?php
                }
                else: echo "Aucune"; endif; ?>
                <hr>
                <h3>Annonces archivées</h3>
                 <?php
                     if($model->getNumberOfArchivedAd($_SESSION['login']) > 0):
                        foreach ($archive_ad_data as $row){ ?>
                         <div class="box-ad">
                             <p class="text-ad"><?= $row['A_titre'] ?>
                                 <a href="/public/ad/show/<?= $row['A_idannonce'] ?>"><span class="ad-button greencolor"><i class="fas fa-eye"></i></span></a>
                                 <a href="/public/ad/delete/<?= $row['A_idannonce'] ?>"><span class="ad-button redcolor"><i class="fas fa-trash"></i></span></a>
                             </p>
                         </div>

                     <?php }
                        else: echo "Aucune"; endif; ?>
                 <?php elseif (isset($messages)):
                    $model_mess = new \App\Models\Messages_model();
                 ?>
                     <br>
                    <h3>Vos conversations</h3>
            <?php
                if(isset($list_conv)): $list = array();
                    foreach ($list_conv as $row){

                        if($_SESSION['login'] == $model_mess->getProprio($row['idad'])){
                            $link = "/public/messages/conv/".$row['idad']."/".$model_mess->getPseudo($row['info']);
                        }else{
                            $link = "/public/messages/conv/".$row['idad']."/".$model_mess->getPseudo($_SESSION['login']);

                        }

                        if(!in_array($link, $list)):
                        ?>

                        <div class="box-ad">
                            <p class="text-ad">Conversation avec <b><?= $model_mess->getPseudo($row['info']) ?></b> pour <b><?= $model->getTitleAd($row['idad']) ?></b>
                                <a href="<?= $link ?>"><span class="ad-button greencolor"><i class="fas fa-eye"></i></span></a>
                            </p>
                        </div>

                        <?php
                        array_push($list, $link);

                        endif;
                    }

                endif;
            ?>



                <?php endif; ?>
                <br>

    <div class="blank"></div>

</div>

</body>
</html>