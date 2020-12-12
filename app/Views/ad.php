<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Annonces - Vue</title>
    <link rel="stylesheet" href="/css/ad.css">
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


$model = new \App\Models\Ad_model();
?>


    <?php if(isset($A_idannonce) && isset($A_titre) && isset($A_cout_loyer) && isset($A_CP) && isset($A_description)
        && isset($A_ville)  && isset($A_superficie) && isset($A_cout_charges) && isset($A_type_chauffage) && isset($A_state)):

        if($A_state == 3): ?>
            <div class="alert--warning">Ceci est une annonce archivée ! Elle n'est donc plus disponible à la location.</div>
        <?php endif ?>


        <div class="container-ad">

        <img src="/public/img/<?= $model->getPhotoByID($A_idannonce) ?>" alt="Avatar" class="image-ad">

        <div class="titre-ad"><?= $A_titre ?></div>
        <div class="prix-ad"><?= $A_cout_loyer ?>€ / mois</div>
        <div class="loc-ad"><i class="fas fa-map-marker-alt"></i> <?= $A_CP." ".$A_ville ?><br>Publié le <?= $model->getDate($A_idannonce) ?></div>
        <div class="desc">Description</div>
        <hr class="line">
        <div class="superficie-ad">Superficie: <?= $A_superficie ?> m²</div>
        <div class="charges-ad">Charges: <?= $A_cout_charges ?>€ / mois</div>
        <div class="charges-ad">Chauffage: <?= $A_type_chauffage ?></div>
        <br>
        <div class="infos-ad"><?= $A_description ?></div>
        <br>
        <div class="btn--info">Contacter le propriétaire</div>
        <br>
    </div>
    <?php endif ?>
<div class="blank"></div>

</body>
</html>