<?php
session_start();
include_once '../../control/functions.php';
isAdmin();
include_once '../../model/functions.php';
?>
<html>
    <head>


    </head>
    <body>
        <?php echo showExitLink("../../");?>
        <h1>Infos vendeur</h1>
        <span id="msg" class="box" style="background-color:white;">
            <h2><?php echo getFieldFromAnyElse("vendeur", "idvendeur", $_GET['idvendeur'], "nom"); ?></h2>
            <p>*******</p>
            <p>Nom d'utilisateur : <?php echo getFieldFromAnyElse("vendeur", "idvendeur", $_GET['idvendeur'], "user"); ?></p>
            <p>Mot de passe haché : <?php echo getFieldFromAnyElse("vendeur", "idvendeur", $_GET['idvendeur'], "pass"); ?></p>
            <a href="addVendeur.php">Retour</a>
        </span>
    </body>  
</html>