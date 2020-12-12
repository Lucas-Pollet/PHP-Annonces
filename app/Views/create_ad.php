<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Annonces - Créer une annonce</title>
    <link rel="stylesheet" href="/css/ad.css">
</head>
<body>
<?php
require_once(APPPATH.'ThirdParty/smarty/Smarty.class.php');

$smarty = new Smarty();

$smarty->display(APPPATH . 'Views/connected_header.tpl');

?>

<div class="container-ad">
    <form method="post" action="/public/ad/create">
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
            <label for="photo">Photos (min 1 / max 5)</label>
            <input id="photo" name="photo" type="file" class="input-form-ad" accept="image/*" multiple>
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