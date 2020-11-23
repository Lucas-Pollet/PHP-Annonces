<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Annonces - Acceuil</title>
    <link rel="stylesheet" href="css/card.css">
</head>
<body>
<?php
session_start();

    require_once(APPPATH.'ThirdParty/smarty/Smarty.class.php');

    $smarty = new Smarty();


if(isset($_SESSION['login'])) {
    $smarty->display(APPPATH . 'Views/connected_header.tpl');
}else{
    $smarty->display(APPPATH . 'Views/header.tpl');
}
?>

        </br>
        <div class="alert--info messagebox">Bienvenue sur ce site de partage d'annonces immobilières entre étudiants !</br>Pour pouvoir ajouter une annonce ou contacter un propriétaire, inscrivez-vous dès maintenant !</div>
        </br>

        <div class="container-card">
            <div class="grid-3 has-gutter paddingcard">
                <div class="annonce-card">
                    <div class="container">
                        <img src="img/appart1.jpg" alt="Avatar" class="image" style="width:100%">
                        <div class="middle">
                            <div class="text">Description</div>
                        </div>
                    </div>

                    <?php if (! empty($ad) && is_array($ad)) : ?>
                            <?php
                        foreach ($ad as $row){
                            echo $row['A_titre'];
                        }?>
                    <?php endif ?>
                    </div>
                <div class="annonce-card"></div>
                <div class="annonce-card"></div>
            </div>
            <div class="grid-3 has-gutter paddingcard">
                <div class="annonce-card"></div>
                <div class="annonce-card"></div>
                <div class="annonce-card"></div>
            </div>
        </div>
</body>
</html>
