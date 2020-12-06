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
        <?php elseif (isset($ad_data)): ?>
             <h3>Annonces publiés</h3>
        <?php
                foreach ($ad_data as $row){ ?>
                        <div class="box-ad">
                            <p class="text-ad"><?= $row['A_titre'] ?>
                                <a href="#" h><span class="edit-button"><i class="fas fa-edit"></i></span></a>
                                <a href="#"><span class="del-button"><i class="fas fa-trash"></i></span></a>
                                </p>


                        </div>

                    <?php
                }
       endif ?>

</div>

</body>

</html>