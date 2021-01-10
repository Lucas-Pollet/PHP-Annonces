<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Annonces - Vue</title>
    <link rel="stylesheet" href="<?= base_url() ?>/public/css/ad.css">
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
$model_mess = new \App\Models\Messages_model();
?>


    <?php if(isset($ad)):
        if($ad['A_state'] == 3): ?>
            <div class="alert--warning">Ceci est une annonce archivée ! Elle n'est donc plus disponible à la location.</div>
        <?php endif ?>


        <div class="container-ad">

            <?php if(isset($photo))
                foreach ($photo as $item){
                    echo "<img src='/public/img/".$item['P_nom']."' class='image-ad'>";
                }?>

        <div class="titre-ad"><?= $ad['A_titre'] ?></div>
        <div class="prix-ad"><?= $ad['A_cout_loyer'] ?>€ / mois</div>
        <div class="loc-ad"><i class="fas fa-map-marker-alt"></i> <?= $ad['A_CP']." ".$ad['A_ville'] ?><br>Publié le <?= $model->getDate($ad['A_idannonce']) ?></div>
        <div class="desc">Description</div>
        <hr class="line">
        <div class="superficie-ad">Superficie: <?= $ad['A_superficie'] ?> m²</div>
        <div class="charges-ad">Charges: <?= $ad['A_cout_charges'] ?>€ / mois</div>
        <div class="charges-ad">Chauffage: <?= $ad['A_type_chauffage'] ?></div>
        <br>
        <div class="infos-ad"><?= $ad['A_description'] ?></div>
        <br>

        <iframe width="100%" frameborder="0" title="map" marginheight="0" marginwidth="0" scrolling="no" src="https://maps.google.com/maps?width=700&amp;height=440&amp;hl=fr&amp;q=<?= $ad['A_ville'] ?>>&amp;ie=UTF8&amp;t=&amp;z=10&amp;iwloc=B&amp;output=embed"></iframe>

        <?php if(isset($_SESSION['login']) && isset($ad['U_mail'])):
                if($_SESSION['login'] != $ad['U_mail']): ?>
                <a href="<?= base_url() ?>/public/messages/conv/<?= $ad['A_idannonce'] ?>/<?= $model_mess->getPseudo($_SESSION['login']) ?>"><div class="btn--info">Contacter le propriétaire</div></a>
            <?php else: ?>
                <a href="<?= base_url() ?>/public/ad/edit/<?= $ad['A_idannonce'] ?>"><div class="btn--warning">Éditer votre annonce</div></a>
            <?php endif; endif; ?>
        <br>


    </div>
    <?php endif ?>
<div class="blank"></div>

</body>
</html>