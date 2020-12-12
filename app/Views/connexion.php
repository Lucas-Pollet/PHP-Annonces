<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Annonces - Connexion</title>
    <link rel="stylesheet" href="/css/log.css">
</head>
<body>
<div class="background">

<?php
    session_start();
    require_once(APPPATH.'ThirdParty/smarty/Smarty.class.php');

    $smarty = new Smarty();
    $smarty->display(APPPATH.'Views/header.tpl');

if (!empty($success)): ?>
        <div class="alert--success"><i class="fas fa-check-circle"></i> <?= $success ?></div>
<?php endif;

if(!empty($erreur)): ?>
    <div class="alert--danger"><i class="fas fa-times"></i> <?= $erreur ?></div>
<?php endif ?>

    <form id="msform" action="http://localhost/public/connexion" method="post">
        <?= csrf_field() ?>

        <fieldset>
            <h2 class="fs-title">Connectez vous</h2>

            <div>
                <label for="email">Email</label>
                <input type="text" name="user_email" placeholder="Votre email" required/>
            </div>
            <div>
                <label for="pwd">Mot de passe</label>
                <input type="password" id="pwd" name="user_pwd" placeholder="Votre mot de passe" required minlength="5">
            </div>

            <p>
                <input type="submit" name="next" class="action-button" value="Se connecter">
            </p>

            <a href="http://localhost/public/inscription">Pas de compte? Inscrivez-vous!</a>

        </fieldset>
    </form>
</div>

</body>
</html>