<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Annonces - Edition annonce</title>
    <link rel="stylesheet" href="<?= base_url() ?>/public/css/annonces.css">
    <script type="text/javascript" src="<?= base_url() ?>/public/css/monjs.js"></script>
</head>
<body>
<?php
require_once(APPPATH.'ThirdParty/smarty/Smarty.class.php');

$smarty = new Smarty();

$smarty->display(APPPATH . 'Views/connected_header.tpl');

?>

<div class="container-ad">
    <form method="post" action="<?= base_url() ?>/public/ad/edit" enctype="multipart/form-data">
        <h2 class="important-title">Édition d'une annonce</h2>
        <br>
        <input name="id" <?php if(isset($A_idannonce)): ?>value="<?= $A_idannonce ?>" <?php endif ?> type="hidden">
        <div>
            <label for="title">Titre de l'annonce</label>
            <input id="title" name="title" type="text" class="input-form-ad" <?php if(isset($A_titre)): ?>value="<?= $A_titre ?>" <?php endif ?> >
        </div>
        <div>
            <label for="loyer">Montant du loyer par mois</label>
            <input id="loyer" name="loyer" type="text" class="input-form-ad" maxlength="5" <?php if(isset($A_cout_loyer)): ?>value="<?= $A_cout_loyer ?>" <?php endif ?> >
        </div>
        <div>
            <label for="charges">Montant des charges par mois</label>
            <input id="charges" name="charges" type="text" class="input-form-ad" maxlength="5" <?php if(isset($A_cout_charges)): ?>value="<?= $A_cout_charges ?>" <?php endif ?> >
        </div>
        <div>
            <label for="loc_cp">Localisation (Code postal)</label>
            <input id="loc_cp" name="loc_cp" type="text" class="input-form-ad" maxlength="5" <?php if(isset($A_CP)): ?>value="<?= $A_CP ?>" <?php endif ?> >
        </div>
        <div>
            <label for="loc_ville">Localisation (Ville)</label>
            <input id="loc_ville" name="loc_ville" type="text" class="input-form-ad" <?php if(isset($A_ville)): ?>value="<?= $A_ville ?>" <?php endif ?>>
        </div>
        <div>
            <label for="chauffage">Type de chauffage</label>
            <select id="chauffage" name="chauffage" class="input-form-ad">
                <option>Électrique</option>
                <option>Fioul</option>
                <option>Gaz</option>
                <option>Collectif</option>
            </select>
        </div>
        <div>
            <label for="locsize">Superficie (en m²)</label>
            <input id="locsize" name="locsize" type="text" class="input-form-ad" maxlength="5" <?php if(isset($A_superficie)): ?>value="<?= $A_superficie ?>" <?php endif ?> >
        </div>
        <div>
            <label>Photos (min 1 / max 5)</label><br>

            <?php if(isset($photo)):
                ?>
                <script>
                    nbad = <?php echo json_encode(sizeof($photo)+1) ; ?>;
                </script>
            <?php
                foreach ($photo as $item){
                    echo "<img src=".base_url()."/public/img/".$item['P_nom']." class='image-ad'>";
                }
                endif;
                if(sizeof($photo) > 0):
                ?>
                    <a href="/public/ad/delphoto/<?= $A_idannonce ?>"><input type="button" class="btn--danger"  value="Supprimer les images existantes"></a>

            <?php endif; $rand = rand(); ?>
            <input type="button" class="btn--info" id="addphoto" onclick="document.getElementById('photo<?= $rand ?>').click()" value="Ajouter une image">

            <input id="photo<?= $rand ?>" name="photo<?= $rand ?>" type="file" style="display: none" onchange="readURL(this);" accept="image/*">

            <ul id="preview"></ul>
        </div>
        <div>
            <label for="desc">Description</label>
            <textarea id="desc" name="desc" class="input-form-ad"><?php if(isset($A_description)): echo $A_description;  endif ?></textarea>
        </div>

        <br>
        <p>
            <input type="submit" class="btn--warning" name="save" value="Sauvegarder">
            <input type="submit" class="btn--info" name="publish" value="Publier">
        </p>
    </form>

</div>

</body>
</html>