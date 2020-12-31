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

<br>
<div class="alert--info messagebox">Bienvenue sur ce site de partage d'annonces immobilières entre étudiants !</br>
    Pour pouvoir ajouter une annonce ou contacter un propriétaire, inscrivez-vous dès maintenant !</br></br>
    <?php if (! empty($nbad)): ?>
        Il y a actuellement <?= $nbad ?> annonces en ligne !
    <?php endif ?></div>
<br>

<div class="container-card">
    <?php
    if(!empty($listad)):
        $i=0;

        $model = new \App\Models\Ad_model();

        echo "<div class='grid-3 has-gutter paddingcard'>";

        foreach ($listad as $row)
        {
            if($row['A_state'] == 2):
                if(($i % 3 == 0) && ($i > 0)){
                    echo "</div><div class='grid-3 has-gutter paddingcard'>";
                }
                if($i < 6):
            ?>

            <div class="annonce-card">
                  <?php if(isset($_SESSION['login']) && ($_SESSION['login'] == $row['U_mail'])): ?>
                    <legend id="legendcard" style="background: #68e397; text-transform: uppercase; text-align: center; padding: 3px">Votre annonce</legend>
                  <?php endif ?>
                    <div class="container">
                        <img src="img/<?= $model->getPhotoByID($row['A_idannonce']) ?>" alt="Avatar" class="image" style="width:100%; margin-top: -5px;">
                        <div class="middle">
                            <div class="text">Les annonces étudiantes partent très vite, dépéchez vous !</div>
                        </div>
                    </div>

                    <div style="margin: 10px">
                        <?php   $date = date_create($row['A_date']);
                                $date = date_format($date, 'd M Y à H:i'); ?>

                        <?=
                        $row['A_titre']."<br>".$row['A_cout_loyer']."€ / mois<br>".$row['A_CP']." ".$row['A_ville']."<br>".$date."<br>"
                        ?>

                        <a href="/public/ad/show/<?= $row['A_idannonce'] ?>" class="bar"><div class="btn--info">En savoir plus</div></a>
                    </div>

            </div>


          <?php

            $i++;
            endif;
            endif;
        }
       echo "</div>";
    endif
    ?>

</div>
<?php $smarty->display(APPPATH . 'Views/footer.tpl'); ?>
</body>
</html>