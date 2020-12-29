<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Annonces - Pages</title>
    <link rel="stylesheet" href="/css/card.css">
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
            ?>

            <div class="annonce-card">
                  <?php if(isset($_SESSION['login']) && ($_SESSION['login'] == $row['U_mail'])): ?>
                    <legend id="legendcard" style="background: #68e397; text-transform: uppercase; text-align: center; padding: 3px">Votre annonce</legend>
                  <?php endif ?>
                    <div class="container">
                        <img src="/public/img/<?= $model->getPhotoByID($row['A_idannonce']) ?>" alt="Avatar" class="image" style="width:100%; margin-top: -5px;">
                        <div class="middle">
                            <div class="text">Les annonces étudiantes partent très vite, dépéchez vous !</div>
                        </div>
                    </div>

                    <div style="margin: 10px">
                        <?=
                        $row['A_titre']."<br>".$row['A_cout_loyer']."€ / mois<br>".$row['A_CP']." ".$row['A_ville']."<br>".$row['A_date']."<br>"
                        ?>

                        <a href="/public/ad/show/<?= $row['A_idannonce'] ?>" class="bar"><div class="btn--info">En savoir plus</div></a>
                    </div>

            </div>


          <?php
            $i++;
            endif;
        }
       echo "</div>";
    endif
    ?>
    <hr>
    <p align="center">Page</p>
    <p align="center">
    <?php
        if(isset($idpage) && isset($total_page)) {
            for ($i = 1; $i <= $total_page; $i++) {
                if ($i == $idpage) {
                    echo ' [ ' . $i . ' ] ';
                } else //Sinon...
                {
                    echo ' <a href="/public/ad/page/' . $i . '">' . $i . '</a> ';
                }
            }
        }
?>
    </p>
    <hr>


</div>
</body>
</html>