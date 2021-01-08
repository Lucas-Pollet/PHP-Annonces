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

if (!empty($success)): ?>
    <div class="alert--success"><i class="fas fa-check-circle"></i> <?= $success ?></div>
<?php endif;

?>

<br>
<div class="container-card">
    <h1>Panel d'administration</h1>
    <a href="/public/admin/listeuti"><div class="btn--info">Gestion des utilisateurs</div></a>
    <a href="/public/admin/listead"><div class="btn--info">Gestion des annonces</div></a>



<?php
    if(isset($users)):
        echo "<h2>Listes des utilisateurs</h2>";
        foreach ($users as $item) {?>
            <div class="box-uti">
                <p class="text-uti"><?= $item['U_pseudo']." - ".$item['U_mail']  ?>
                    <div style="padding: 15px">
                    <a href="/public/admin/delaccount/<?= $item['U_mail'] ?>"><div class="btn--info">Envoyer un mail</div></a>
                    <a href="/public/admin/delaccount/<?= $item['U_mail'] ?>"><div class="btn--warning">Editer le profil</div></a>
                    <a href="/public/admin/blockad/<?= $item['U_mail'] ?>"><div class="btn--danger">Bloquer les annonces</div></a>
                    <a href="/public/admin/delaccount/<?= $item['U_mail'] ?>"><div class="btn--danger">Supprimer le compte</div></a>
                </div>
                </p>
            </div>

        <?php
        }
    endif;

    if(isset($edit_profil)):

    if (!empty($account['U_pseudo']) && !empty($account['U_prenom']) && !empty($account['U_nom']) && !empty($account['U_mail'])): ?>
    <h4>Pseudo: <?= $account['U_pseudo'] ?><a href="/public/public/account/modifnom/">
            <button class="btn--info">Modifier</button>
        </a></h4>
    <h4>Nom: <?= $account['U_prenom'] . " " . $account['U_nom'] ?> <a href="/public/public/account/modifnom/">
            <button class="btn--info">Modifier</button>
        </a></h4>
    <h4>Adresse email: <?= $account['U_mail'] ?> <a href="/public/public/account/modifmail/">
            <button class="btn--info">Modifier</button>
        </a></h4>
    <br>
<?php
    endif;
    endif;
?>
</div>

</body>
</html>