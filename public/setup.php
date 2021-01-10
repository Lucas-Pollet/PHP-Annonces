<html>
<head>
    <title>Installation du site</title>
</head>
<style>
    body{
        background: lightgrey;
    }
    .center{
        text-align: center;
    }
    input{
        padding: 4px;
        margin: 3px;
    }
</style>

<body>
    <div class="center">
        <h1>Installation du site Annonces Immobilières</h1>
        <br>
        <form action="setup.php" method="post">
            <label>Adresse du site</label>
            <input name="url" id="url" type="text" />

            <h3>Configuration base de données</h3>

            <label>Hostname : </label>
            <input name="bdd_hostname" type="text">
            <br>
            <label>User : </label>
            <input name="bdd_user" type="text">
            <br>
            <label>Password : </label>
            <input name="bdd_password" type="password">
            <br>
            <label>Database name : </label>
            <input name="bdd_name" type="text">

            <h3>Création compte Admin</h3>

            <label>Email : </label>
            <input name="email" type="text">
            <br>
            <label>Nom : </label>
            <input name="name" type="text">
            <br>
            <label>Prénom : </label>
            <input name="prename" type="text">
            <br>
            <label>Mot de passe : </label>
            <input name="password" type="password">
            <br>
            <label>Confirmation : </label>
            <input name="confirm" type="password">
            <br>

            <input type="submit" value="Valider les informations">
        </form>
    </div>
</body>
</html>

<?php
if(isset($_POST['bdd_hostname']) && isset($_POST['bdd_user']) && isset($_POST['bdd_password']) && isset($_POST['bdd_name']) &&
isset($_POST['email']) && isset($_POST['name']) && isset($_POST['prename']) && isset($_POST['password']) && isset($_POST['confirm']) && isset($_POST['url'])){


    $db = new PDO("mysql:host=" . $_POST['bdd_hostname'] . ";dbname=" . $_POST['bdd_name'], $_POST['bdd_user'], $_POST['bdd_password']);
    $query = file_get_contents("creation_table.sql");
    $stmt = $db->prepare($query);
    $stmt->execute();

    $data = [
        'hostname' => $_POST['bdd_hostname'], 'dbname' => $_POST['bdd_name'], 'user' => $_POST['bdd_user'], 'pwd' => $_POST['bdd_password'], 'url' => $_POST['url']
    ];

    if($_POST['password'] != $_POST['confirm']){
        die("Les deux mdp ne sont pas identiques");
    }

    $sql = $db->prepare("INSERT INTO t_utilisateur VALUES(?, ?, 'Admin', ?, ?)");
    $sql->execute(array($_POST['email'], crypt($_POST['password'], 'pwd_key'), $_POST['name'], $_POST['prename']));

    $sql2 = $db->prepare("INSERT INTO t_admin VALUES (?, 1)");
    $sql2->execute(array($_POST['email']));

    $fp = fopen('config.json', 'w');
    fwrite($fp, json_encode($data));
    fclose($fp);

    header('Location: index.php');
}
?>