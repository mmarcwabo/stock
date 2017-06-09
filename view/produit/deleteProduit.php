<?php
session_start();
include_once '../../control/functions.php';
checkSessionValidity();

$idproduit = (isset($_GET['idproduit'])) ? $_GET['idproduit'] : "";
$produit = [];
if (!is_numeric($idproduit)) {
    header("Location:addProduit.php");
}
include_once '../../model/functions.php';
?>
<html>
    <head>
        <meta charset="utf-8">
        <title>Supprimer produit</title>
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
            </div>
            <div class="row col-lg-12 col-md-12 col-sm-12">
                <div class="col-lg-4">
                    <br/>
                    <?php echo showExitLink("../../"); ?>
                    <legend>Supprimer produit</legend>
                    <h2><?php echo getFieldFromAnyElse("produit", "idproduit", $idproduit, "denomination"); ?></h2>

                    <label for="confirmation">Etes - vous sûr(e) de vouloir supprimer ce produit?</label><br/>
                    <form role="form" method="POST" action="addProduit.php">
                        <input class="btn btn-success btn-sm" name="submit" type="submit" value="Non"/>
                    </form>
                    <form role="form" method="POST" action="addProduit.php">
                        <input class="btn btn-success btn-sm" name="submit" type="submit" value="Annuler"/>
                    </form>
                    <form role="form" method="POST" action="../../control/produit.php?action=delete&idproduit=<?php echo $idproduit; ?>">
                        <input class="btn btn-danger btn-sm" name="submit" type="submit" value="Oui" />
                    </form>
                </div>
                <div class="col-lg-8">
                    <?php echo "<br>"; ?>
                    <legend>Produits en stock...</legend>
                    <span id="msg" style="color:green;"><br/></span>
                        <?php
                        $fieldNameArray = ['Libellé', 'Prix', 'Quantité', 'Description', 'Action'];
                        showProduit($fieldNameArray, 'denomination');
                        ?>
                </div>
            </div>
        </div>
        <script type="text/javascript" src="../../js/bootstrap.min.js"></script>
        <script type="text/javascript" src="../../js/jquery.min.js"></script>
        <script type="text/javascript">
            $(document).ready(function () {
                //Ajax saving
                $("#msg").show();
                $('#dataForm')[0].reset();
                $("#msg").delay(5000).fadeOut(300);
            });
        </script>
    </body>  
</html>
