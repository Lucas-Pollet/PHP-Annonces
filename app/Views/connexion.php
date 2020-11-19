<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Annonces - Connexion</title>
    <link rel="stylesheet" href="log.css">
</head>
<body>
<div class="background">
    <?php
    require_once(APPPATH.'ThirdParty/smarty/Smarty.class.php');

    $smarty = new Smarty();
    $smarty->display(APPPATH.'Views/header.tpl');
    ?>

    <form id="msform">
        <fieldset>
            <h2 class="fs-title">Connectez vous</h2>

            <div>
                <label for="email">Email</label>
                <input type="text" name="email" placeholder="Votre email" required/>
            </div>
            <div>
                <label for="pwd">Mot de passe</label>
                <input type="password" id="pwd" name="user_pwd" placeholder="Votre mot de passe" required minlength="5">
            </div>

            <p>
                <input type="button" name="next" class="action-button" value="Se connecter">
            </p>

            <a href="./inscription">Pas de compte? Inscrivez-vous!</a>

        </fieldset>
    </form>
</div>
</body>
</html>