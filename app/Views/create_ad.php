<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Annonces - Créer une annonce</title>
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
    <form method="post" action="<?= base_url() ?>/public/ad/create" enctype="multipart/form-data">
        <h2 class="important-title">Créer une nouvelle annonce</h2>
        <br>
        <div>
            <label for="title">Titre de l'annonce</label>
            <input id="title" name="title" type="text" class="input-form-ad" required>
        </div>
        <div>
            <label for="loyer">Montant du loyer par mois</label>
            <input id="loyer" name="loyer" type="text" class="input-form-ad" maxlength="5">
        </div>
        <div>
            <label for="charges">Montant des charges par mois</label>
            <input id="charges" name="charges" type="text" class="input-form-ad" maxlength="5">
        </div>
        <div>
            <label for="loc_cp">Localisation (Code postal)</label>
            <input id="loc_cp" name="loc_cp" type="text" class="input-form-ad" maxlength="5">
        </div>
        <div>
            <label for="loc_ville">Localisation (Ville)</label>
            <input id="loc_ville" name="loc_ville" type="text" class="input-form-ad">
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
            <input id="locsize"name="locsize" type="text" class="input-form-ad" maxlength="5">
        </div>
        <div>
            <label>Photos (min 1 / max 5)</label><br>
            <?php $rand = rand(); ?>
            <input type="button" class="btn--info" id="addphoto" onclick="document.getElementById('photo<?= $rand ?>').click()" value="Ajouter une image">

            <input id="photo<?= $rand ?>" name="photo<?= $rand ?>" type="file" style="display: none" onchange="readURL(this);" accept="image/*">

            <ul id="preview"></ul>
        </div>

        <div>
            <label for="desc">Description</label>
            <textarea id="desc" name="desc" class="input-form-ad"></textarea>
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