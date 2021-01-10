<!doctype html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Annonces - Compte</title>
    <link rel="stylesheet" href="<?= base_url() ?>/public/css/ad.css">
</head>

<body>
<?php

require_once(APPPATH.'ThirdParty/smarty/Smarty.class.php');

$smarty = new Smarty();

$smarty->display(APPPATH . 'Views/connected_header.tpl');

$model = new \App\Models\Ad_model();

if (!empty($success)): ?>
    <div class="alert--success"><i class="fas fa-check-circle"></i> <?= $success ?></div>
<?php endif;

?>

<br>
<div class="container-card">
    <h1>Panel d'administration</h1>
    <a href="<?= base_url() ?>/public/admin/listeuti"><div class="btn--info">Gestion des utilisateurs</div></a>
    <a href="<?= base_url() ?>/public/admin/listead"><div class="btn--info">Gestion des annonces</div></a>



<?php
    if(isset($listead)):

        foreach ($listead as $row){ ?>
        <div class="box-ad">
            <p class="text-ad"><?= $row['A_titre'] ?> -
                <?php if($model->getState($row['A_idannonce']) == 1):  ?>Rédaction<?php elseif($model->getState($row['A_idannonce']) == 2): ?> Publié le <?= $model->getDate($row['A_idannonce']); else:?>
                Archive
                <?php endif ?>

                <a href="/public/ad/show/<?= $row['A_idannonce'] ?>"><span class="ad-button greencolor"><i class="fas fa-eye"></i></span></a>
                <a href="/public/admin/archive/<?= $row['A_idannonce'] ?>"><span class="ad-button browncolor"><i class="fas fa-archive"></i></span></a>
                <a href="/public/admin/delmessage/<?= $row['A_idannonce'] ?>"><span class="ad-button redcolor"><i class="far fa-calendar-times"></i></span></a>
                <a href="/public/admin/delete/<?= $row['A_idannonce'] ?>"><span class="ad-button redcolor"><i class="fas fa-trash"></i></span></a>
            </p>
        </div>

        <?php
    }
         endif;
    if(isset($users)):
        echo "<h2>Listes des utilisateurs</h2>";
        foreach ($users as $item) {?>
            <div class="box-uti">
                <p class="text-uti"><?= $item['U_pseudo']." - ".$item['U_mail']  ?>
                    <div style="padding: 15px">
                    <a href="<?= base_url() ?>/public/admin/sendmail/<?= $item['U_mail'] ?>"><div class="btn--info">Envoyer un mail</div></a>
                    <a href="<?= base_url() ?>/public/admin/editprofil/<?= $item['U_mail'] ?>"><div class="btn--warning">Editer le profil</div></a>
                    <a href="<?= base_url() ?>/public/admin/blockad/<?= $item['U_mail'] ?>"><div class="btn--danger">Bloquer les annonces</div></a>
                    <a href="<?= base_url() ?>/public/admin/delaccount/<?= $item['U_mail'] ?>"><div class="btn--danger">Supprimer le compte</div></a>
                </div>
                </p>
            </div>

        <?php
        }
    endif;

    if(isset($account)):

    if (!empty($account['U_pseudo']) && !empty($account['U_prenom']) && !empty($account['U_nom']) && !empty($account['U_mail'])): ?>
    <h2>Edition du profil de <?= $account['U_pseudo'] ?></h2>
    <form method="post" action="<?= base_url() ?>/public/admin/editprofil">
        <h4>Pseudo: <input name="pseudo" value="<?= $account['U_pseudo'] ?>"></h4>
        <h4>Prénom: <input name="prename" value="<?= $account['U_prenom'] ?>"></h4>
        <h4>Nom: <input name="name" value="<?= $account['U_nom'] ?>"></h4>
        <h4>Adresse email: <?= $account['U_mail'] ?></h4>
        <br>
        <input type="hidden" name="id" value="<?= $account['U_mail'] ?>">
        <input type="submit" value="Valider" class="btn--info">
    </form>
    <br>
<?php
    endif;
    endif;

    if(isset($message)):
?>
    <form method="post" action="<?= base_url() ?>/public/admin/sendmail">
        <h2>Envoi de mail à <?php if(isset($mail)) echo $mail ?></h2>
       <br>
       <textarea name="message"></textarea>
        <br>
        <input type="submit" value="Envoyer" class="btn--info">
        <input type="hidden" name="mail" value="<?= $mail ?>">
    </form>
<?php endif; ?>
</div>

</body>
</html>