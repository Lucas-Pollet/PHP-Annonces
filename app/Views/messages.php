<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Annonces - Messages</title>

    <link rel="stylesheet" href="<?= base_url() ?>/public/css/messages.css">
</head>
<body>
<?php
require_once(APPPATH.'ThirdParty/smarty/Smarty.class.php');

$smarty = new Smarty();

if(isset($_SESSION['login'])) {
    $smarty->display(APPPATH . 'Views/connected_header.tpl');
}else{
    $smarty->display(APPPATH . 'Views/header.tpl');
}
$model = new \App\Models\Messages_model();
?>


<div style="font-size: 24px; margin-left: 5%; padding: 10px">Conversation avec <b>
       <?php if(isset($proprio) && isset($id2)){
           if($model->getPseudo($_SESSION['login']) == $proprio){
                echo $id2;
           }else {
               echo $proprio;
           }
       }?>
    </b> pour l'annonce
    <b><?php if(isset($title_ad)) echo $title_ad ?></b>
</div>

    <div class="box-tchat">
        <?php
        if(isset($all_messages)) {
            foreach ($all_messages as $row) {
                if($row['U_mail'] == $_SESSION['login']){
                    echo '<div class="right-message">'.$row['M_texte'].'</div>';
                }else{
                    echo '<div class="left-message">'.$row['M_texte'].'</div>';
                }
            }
        }
        ?>

    </div>


    <div class="container-input">
        <form method="post" action="<?= base_url() ?>/public/messages/conv">
            <p align="center"><input type="text" class="input" name="texte" id="message" placeholder="Votre message"></p>
            <input type="submit" class="btn--info button">
            <input name="id" <?php if(isset($id)): ?>value="<?= $id ?>" <?php endif ?> type="hidden">
            <input name="id2" <?php if(isset($id2)): ?>value="<?= $id2 ?>" <?php endif ?> type="hidden">
        </form>
    </div>
</body>
</html>