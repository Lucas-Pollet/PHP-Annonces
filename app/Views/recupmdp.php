<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Annonces - Recuperation MDP</title>
    <link rel="stylesheet" href="<?= base_url() ?>/public/css/log.css">
</head>
<body>
<div class="background">

    <?php
    session_start();
    require_once(APPPATH.'ThirdParty/smarty/Smarty.class.php');

    $smarty = new Smarty();
    $smarty->display(APPPATH.'Views/header.tpl');
    if (!empty($erreur)):?>
        <div class="alert--danger"><i class="fas fa-times"></i> <?= $erreur ?></div>
    <?php endif;


    if (!empty($modifpwd)): ?>
        <form id="msform" action="<?= base_url() ?>/public/account/modifpwdwithtoken" method="post">
            <?= csrf_field() ?>

            <fieldset>
                <h2 class="fs-title">Modification mot de passe</h2>

                <div>
                    <label for="pwd">Nouveau Mot de passe</label>
                    <input type="password" id="pwd" name="user_pwd" placeholder="Votre mot de passe" required minlength="5">
                </div>
                <div>
                    <label for="confirm">Confirmation</label>
                    <input type="password" id="confirm" name="user_confirm" placeholder="Confirmation" required>
                </div>

                <p>
                    <input name="id" <?php if(isset($mail)): ?>value="<?= $mail ?>" <?php endif ?> type="hidden">
                    <input type="submit" name="next" class="action-button" value="Valider">
                </p>
            </fieldset>
        </form>
    <?php else:
    if (!empty($success)): ?>
        <div class="alert--success"><i class="fas fa-check-circle"></i> <?= $success ?></div>

  <form id="msform" action="<?= base_url() ?>/public/account/testtoken" method="post">
        <?= csrf_field() ?>

    <fieldset>
        <h2 class="fs-title">Mot de passe oublié</h2>

        <p>Entrez maintenant votre email le code reçu par mail !</p>

        <div>
            <label for="email">Votre email</label>
            <input type="email" id="email" name="user_email" placeholder="Votre email" required/>
        </div>
        <div>
            <label for="token">Code reçu</label>
            <input type="text" id="token" name="token" placeholder="Votre code" required/>
        </div>
        <p>
            <input type="submit" name="next" class="action-button" value="Envoyer">
        </p>
    </fieldset>
    </form>
    <?php else: ?>

    <form id="msform" action="<?= base_url() ?>/public/account/recupmdp" method="post">
        <?= csrf_field() ?>

        <fieldset>
            <h2 class="fs-title">Mot de passe oublié</h2>

            <p>Nous allons vous envoyez un mail permettant de récupérer l'accès à votre compte</p>

            <div>
                <label for="email">Votre email</label>
                <input type="email" id="email" name="user_email" placeholder="Votre email" required/>
            </div>
            <p>
                <input type="submit" name="next" class="action-button" value="Envoyer">
            </p>
        </fieldset>
    </form>
    <?php  endif; endif; ?>


</div>

</body>
</html>