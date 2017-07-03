<?php
session_start();

include_once '../../control/functions.php';
checkSessionValidity();

include_once '../../model/functions.php';
$idproduit = (isset($_GET['idproduit'])) ? $_GET['idproduit'] : "";
if (!is_numeric($idproduit)) {
    header("Location:addProduit.php");
}
?>
<html>
    <head>
        <meta charset="utf-8">
        <title>Opération sur Stock</title>
        <link rel="stylesheet" type="text/css" href="../../css/bootstrap-theme.css" />
        <link rel="stylesheet" type="text/css" href="../../css/bootstrap.css"/>
        <link rel="stylesheet" type="text/css" href="../../css/style.css"/>
    </head>
    <body>
        <div class="container">
            <div class="top">
                <a href="../produit/addProduit.php">
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
                    <br/>
                    <legend>Opération sur Stock</legend>
                    <span id="msg" class="box" style="background-color:white;">
                        <?php echo (isset($_GET['param'])) ? $_GET['param'] : "<p style='color:green'>Effectuer ici des entées et sorties...</p>"; ?></span>


                    <form role="form" method="POST" action="../../control/operation.php">
                        <div class="form-group">
                        <label for="denomination">Produit : </label>
                        <input class="form-control" type="text" name="denominationProduit" value="<?php echo getFieldFromAnyElse("produit", "idproduit", $idproduit, "denomination"); ?>" readonly="readonly"/><br/>
                        </div>
                        <div class="radio">
                        <legend>Opération : </legend>
                        <label><input type="radio" name="type" checked="checked" value="E" />Entrée</label>
                        <label><input type="radio" name="type" checked="" value="S" />Sortie</label>
                        </div>
                        <div class="form-group">
                        <label for="quantite">Quantité : </label>
                        <input class="form-control" type="text" name="quantite" value="" />
                        </div>
                        <input class="btn btn-primary" type="submit" value="Confirmer opération" name="submit" />
                    </form>
                </div>
            </div>
        </div>
    </body>  
</html>