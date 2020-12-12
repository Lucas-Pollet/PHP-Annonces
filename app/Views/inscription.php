<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Annonces - Inscription</title>
    <link rel="stylesheet" href="css/log.css">
</head>
<body>
<div class="background">
<?php
require_once(APPPATH.'ThirdParty/smarty/Smarty.class.php');

$smarty = new Smarty();
$smarty->display(APPPATH.'Views/header.tpl');

if (!empty($erreur)):
?>
    <div class="alert--danger"><i class="fas fa-times"></i> <?= $erreur ?></div>
<?php endif ?>

    <form id="msform" action="./inscription" method="post">
        <?= csrf_field() ?>

        <fieldset>
            <h2 class="fs-title">Créez votre compte</h2>

            <div>
                <label for="email">Email</label>
                <input type="email" id="email" name="user_email" placeholder="Votre email" required/>
            </div>
            <div>
                <label for="login">Pseudo</label>
                <input type="text" id="login" name="user_login" placeholder="Votre pseudo" required>
            </div>
            <div>
                <label for="name">Nom</label>
                <input type="text" id="name" name="user_name" placeholder="Votre nom" required>
            </div>
            <div>
                <label for="prename">Prénom</label>
                <input type="text" id="prename" name="user_prename" placeholder="Votre prénom" required>
            </div>
            <div>
                <label for="pwd">Mot de passe</label>
                <input type="password" id="pwd" name="user_pwd" placeholder="Votre mot de passe" required minlength="5">
            </div>
            <div>
                <label for="confirm">Confirmation</label>
                <input type="password" id="confirm" name="user_confirm" placeholder="Confirmation" required>
            </div>

            <p>
                <input type="reset" name="delete" class="action-button-red" value="Effacer">
                <input type="submit" name="next" class="action-button" value="Valider">
            </p>

        </fieldset>
    </form>
</div>

</body>
</html>
