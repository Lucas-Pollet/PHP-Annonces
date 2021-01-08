<!doctype html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Annonces - Compte</title>
    <link rel="stylesheet" href="/css/log.css">
</head>

<body>
<?php

require_once(APPPATH.'ThirdParty/smarty/Smarty.class.php');

$smarty = new Smarty();

$smarty->display(APPPATH . 'Views/connected_header.tpl');

if (!empty($erreur)):
?>
<div class="alert--danger"><i class="fas fa-times"></i> <?= $erreur ?></div>
<?php endif;

if(!empty($modifnom)):
?>
    <form id="msform" action="http://localhost/public/account/modifnom" method="post">
        <?= csrf_field() ?>

        <fieldset>
            <h2 class="fs-title">Modification prénom / nom</h2>

            <div>
                <label for="nom">Nouveau nom</label>
                <input type="text" id="nom" name="user_name" placeholder="Votre nom" required/>
            </div>
            <div>
                <label for="prename">Nouveau prénom</label>
                <input type="text" id="prename" name="user_prename" placeholder="Votre prénom" required>
            </div>

            <p>
                <input type="submit" name="next" class="action-button" value="Valider">
            </p>
        </fieldset>
    </form>

<?php elseif (!empty($modifpseudo)): ?>
    <form id="msform" action="http://localhost/public/account/modifpseudo" method="post">
        <?= csrf_field() ?>

        <fieldset>
            <h2 class="fs-title">Modification pseudo</h2>

            <div>
                <label for="pseudo">Nouveau pseudo</label>
                <input type="text" id="pseudo" name="user_pseudo" placeholder="Votre pseudo" required/>
            </div>

            <p>
                <input type="submit" name="next" class="action-button" value="Valider">
            </p>
        </fieldset>
    </form>
<?php elseif (!empty($modifmail)): ?>
    <form id="msform" action="http://localhost/public/account/modifmail" method="post">
        <?= csrf_field() ?>

        <fieldset>
            <h2 class="fs-title">Modification email</h2>

            <div>
                <label for="email">Nouveau mail</label>
                <input type="email" id="email" name="user_email" placeholder="Votre email" required/>
            </div>

            <p>
                <input type="submit" name="next" class="action-button" value="Valider">
            </p>
        </fieldset>
    </form>
<?php elseif (!empty($modifpwd)): ?>
    <form id="msform" action="http://localhost/public/account/modifpwd" method="post">
        <?= csrf_field() ?>

        <fieldset>
            <h2 class="fs-title">Modification mot de passe</h2>

            <div>
                <label for="oldpwd">Ancien Mot de passe</label>
                <input type="password" id="oldpwd" name="user_oldpwd" placeholder="Ancien mot de passe" required minlength="5">
            </div>
            <div>
                <label for="pwd">Nouveau Mot de passe</label>
                <input type="password" id="pwd" name="user_pwd" placeholder="Votre mot de passe" required minlength="5">
            </div>
            <div>
                <label for="confirm">Confirmation</label>
                <input type="password" id="confirm" name="user_confirm" placeholder="Confirmation" required>
            </div>

            <p>
                <input type="submit" name="next" class="action-button" value="Valider">
            </p>
        </fieldset>
    </form>
<?php elseif (!empty($delaccount)): ?>
    <form id="extended-msform" action="http://localhost/public/account/delaccount" method="post">
        <?= csrf_field() ?>

        <fieldset>
            <h2 class="fs-title">Suppression de votre compte</h2>

            <p class="red-bold-text">Attention, la suppression de votre compte entraine la perte de vos annonces, vos messages et vos données personnelles !!</p>

            <p>
                <a href="/public/account"><input type="button" name="back" class="action-button-grey" value="Annuler"></a>
                <input type="submit" name="next" class="action-button-red" value="Valider">
            </p>
        </fieldset>
    </form>

<?php endif ?>

</body>