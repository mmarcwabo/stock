<?php
session_start();
include_once '../../control/functions.php';
isAdmin();

$idvendeur = (isset($_GET['idvendeur'])) ? $_GET['idvendeur'] : "";
$vendeur = [];
if (!is_numeric($idvendeur)) {
    header("Location:addVendeur.php");
} else {
    include_once '../../model/functions.php';
    $vendeur = (array) editVendeur($idvendeur);
}
?>
<html>
    <head>
        <meta charset="utf-8">
        <title>Ajouter vendeur</title>
        <link rel="stylesheet" type="text/css" href="../../css/bootstrap-theme.css" />
        <link rel="stylesheet" type="text/css" href="../../css/bootstrap.css"/>
        <link rel="stylesheet" type="text/css" href="../../css/style.css"/>
    </head>
    <body>
        <div class="container">
            <div class="top">
                <a href="#">
                    <strong>&laquo; Gestion des stock &laquo;</strong>
                </a>
                <span class="right">
                    <a href="#" target="_blank"></a>
                    <?php echo showExitLink("../../"); ?>

                </span>

                <div class="clr"></div>
            </div>
            <div class="row col-lg-12 col-md-12 col-sm-12">
                <div class="col-lg-3">
                    <?php echo showExitLink("../../"); ?>
                    <legend>Modifier vendeur</legend>
                    <span id="msg" class="box" style="background-color:white;">
                        <?php echo (isset($_GET['param'])) ? $_GET['param'] : "<p style='color:green'>Modifier vendeur...</p>"; ?></span>

                    <form method="POST" action="../../control/vendeur.php?action=edit&idvendeur=<?php echo $idvendeur; ?>">
                        <label for="denomination">Modifier Nom : </label>
                        <input type="text" name="nom" value="<?php echo $vendeur['nom']; ?>"/><br/>
                        <label for="prix">Modifier user : </label>
                        <input type="text" name="user" value="<?php echo $vendeur['user']; ?>"/><br/>
                        <label for="description">Modifier mot de passe : </label>
                        <input name="pass" type="password" value="" placeholder="Saisir nouveau mot de passe"/>
                        <br/>
                        <input type="submit" value="Modifier vendeur" name="submit" />
                    </form>
                </div>
                <div class="col-lg-9">
                    <?php
                    include_once '../../model/functions.php';
                    $fieldNameArray = ['ID Vendeur', 'Nom', 'User'];
                    showVendeur($fieldNameArray, 'nom');
                    ?>
                </div>
            </div>
        </div>
    </body>  
</html>

