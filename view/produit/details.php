<?php
session_start();
include_once '../../control/functions.php';
checkSessionValidity();
include_once '../../model/functions.php';
?>
<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Détails produit</title>
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
                <br/>
                
                <legend>Infos produit</legend>
                <span id="" class="box" style="background-color:white;">
                    <h2><?php echo getFieldFromAnyElse("produit", "idproduit", $_GET['idProduit'], "denomination"); ?></h2>
                    <p>Photo : </p>
                    <p>Quantité en stock : <?php echo getFieldFromAnyElse("stock", "produit_idproduit", $_GET['idProduit'], "qtestockee"); ?></p>
                    <p>Description : <?php echo getFieldFromAnyElse("produit", "idproduit", $_GET['idProduit'], "description"); ?></p>
                    <a href="addProduit.php">Retour</a>
                </span>
            </div>
        </div>
        <script type="text/javascript" src="../../js/bootstrap.min.js"></script>
        <script type="text/javascript" src="../../js/jquery.min.js"></script>
        <script type="text/javascript">
            $(document).ready(function () {
                //Ajax saving
                $("#msg").show();
                $("#msg").delay(5000).fadeOut(300);
            });
        </script>
    </body>  
</html>