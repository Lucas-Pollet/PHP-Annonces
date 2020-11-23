<!doctype html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Annonces - Compte</title>
</head>

<body>
<?php

require_once(APPPATH.'ThirdParty/smarty/Smarty.class.php');

$smarty = new Smarty();

$smarty->display(APPPATH . 'Views/connected_header.tpl');

?>

</br>
<div class="container-card">
<div class="tabs js-tabs">
    <nav class="tabs-menu">
        <a href="#tabnav1" class="tabs-menu-link is-active">Mon compte</a>
        <a href="#tabnav2" class="tabs-menu-link">Mes annonces</a>
        <a href="#tabnav3" class="tabs-menu-link">Mes messages</a>
    </nav>

    <div class="tabs-content">
        <div id="tabnav1" class="tabs-content-item">
            <h2><i class="fas fa-user-alt"></i> Profil</h2>
            <?php if(!empty($U_pseudo) && !empty($U_prenom) && !empty($U_nom) && !empty($U_mail)): ?>
            <h4>Votre pseudo: <?= $U_pseudo?></h4>
            <h4>Votre nom: <?= $U_prenom." ". $U_nom?> <a href="/public/public/account/modifnom/"><button class="btn--info">Modifier</button></a></h4>
            <h4>Votre adresse email: <?= $U_mail ?> <a href="/public/public/account/modifmail/"><button class="btn--info">Modifier</button></a></h4><br>
            <a href="/public/public/account/modifpwd/"><button class="btn--info">Modifier mon mot de passe</button></a><br><br>
            <a href="/public/public/account/delaccount/"><button class="btn--warning">Supprimer mon compte</button></a>
            <?php endif ?>
        </div>
        <div id="tabnav2" class="tabs-content-item">Contenu 2.</div>
        <div id="tabnav3" class="tabs-content-item">Contenu 3.</div>
    </div>
</div>
</div>
<script src="/css/jquery-3.3.1.min.js"></script>
<script src="/css/tabs.js"></script>

</body>

</html>