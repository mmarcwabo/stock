<?php
session_start();
include_once '../../control/functions.php';
checkSessionValidity();
$idproduit = (isset($_GET['idproduit'])) ? $_GET['idproduit'] : "";
$produit = [];
if (!is_numeric($idproduit)) {
    header("Location:addProduit.php");
} else {
    include_once '../../model/functions.php';
    $produit = (array) editProduit($idproduit);
}
?>
<html>
    <head>
        <meta charset="utf-8">
        <title>Modifier produit</title>
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
                <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
                    <br/>
                    <legend>Modifier produit</legend>
                    <span id="msg" class="box" style="background-color:white;">
                        <?php echo (isset($_GET['param'])) ? $_GET['param'] : "<p style='color:green'>Saisissez les nouvelles informations ici...</p>"; ?></span>

                    <form role="form" method="POST" action="../../control/produit.php?action=edit&idproduit=<?php echo $idproduit; ?>">
                        <div class="form-group">
                            <label for="denomination">Libellé : </label>
                            <input class="form-control" type="text" name="denomination" value="<?php echo $produit['denomination']; ?>" placeholder="Saisir libellé" /><br/>
                        </div>
                        <div class="form-group">
                            <label for="prix">Prix unitaire : </label>
                            <input  class="form-control" type="text" name="prix" value="<?php echo $produit['prix']; ?>" placeholder="Saisir prix unitaire"/><br/>
                        </div>
                        <div class="form-group">
                            <label for="description">Description : </label>
                            <input  class="form-control" name="description" type="text" value="<?php echo $produit['description']; ?>"/>
                        </div>
                        <button type="submit" class="btn btn-primary"  name="submit">Modifier produit</button>
                    </form>
                </div>
                <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8 ">
                    <br/>
                    <?php
                    $fieldNameArray = ['Libellé', 'Prix[$]', 'Quantité', 'Description', 'Action'];
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
                $("#msg").delay(5000).fadeOut(300);
            });
        </script>
    </body>  
</html>