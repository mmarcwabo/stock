<?php
session_start();
include_once '../../control/functions.php';
isAdmin();

$idvendeur = (isset($_GET['idvendeur'])) ? $_GET['idvendeur'] : "";
$produit = [];
if (!is_numeric($idvendeur)) {
    header("Location:addVendeur.php");
}
include_once '../../model/functions.php';
?>
<html>
    <head>


    </head>
    <body>
        <?php echo showExitLink("../../"); ?>
        <h1>Supprimer vendeur</h1>
        <h2><?php echo getFieldFromAnyElse("vendeur", "idvendeur", $idvendeur, "nom"); ?></h2>

        <label for="confirmation">Etes - vous sûr(e) de vouloir supprimer ce produit?</label><br/>
        <form method="POST" action="addVendeur.php">
            <input name="submit" type="submit" value="Non"/>
        </form>
        <form method="POST" action="addVendeur.php">
            <input name="submit" type="submit" value="Annuler"/>
        </form>
        <form method="POST" action="../../control/vendeur.php?action=delete&idvendeur=<?php echo $idvendeur; ?>">
            <input name="submit" type="submit" value="Oui" />
        </form>
        <?php
        include_once '../../model/functions.php';
        $fieldNameArray = ['ID Vendeur', 'Nom', 'User'];
        showVendeur($fieldNameArray, 'nom');
        ?>
    </body>  
</html>


