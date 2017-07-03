<?php
session_start();
include_once '../../control/functions.php';
checkSessionValidity();

$den = (isset($_GET['den'])) ? $_GET['den'] : "";
$des = (isset($_GET['des'])) ? $_GET['des'] : "";
$pr = (isset($_GET['pr'])) ? $_GET['pr'] : "";
$qu = (isset($_GET['qu'])) ? $_GET['qu'] : "";
?>
<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Ajouter produit</title>
        <link rel="stylesheet" type="text/css" href="../../css/bootstrap-theme.css" />
        <link rel="stylesheet" type="text/css" href="../../css/bootstrap.css"/>
        <link rel="stylesheet" type="text/css" href="../../css/style.css"/>
    </head>
    <body>
        <div class="container">
            <div class="top">
                <a href="addProduit.php">
                    <strong>&laquo; Gestion des stock &laquo;</strong>
                </a>
                <input type="text" name="typeahead" class="typeahead tt-query" autocomplete="off" placeholder="Rechercher article...">
                <span class="right">
                    <a href="#" target="_blank"></a>
                    <?php echo showExitLink("../../"); ?>

                </span>

                <div class="clr"></div>
            </div>
            <div class="row col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-3">
                    <br/>
                    <legend>Ajouter nouvel article</legend>
                    <span id="msg" style="background-color:white;"><?php echo (isset($_GET['param'])) ? $_GET['param'] : ""; ?></span>

                    <form role="form" method="POST" action="../../control/produit.php?action=add">
                        <div class="form-group">
                            <label for="denomination">Article : </label>
                            <input class="form-control" type="text" name="denomination" value="<?php echo $den; ?>" placeholder="Saisir libellé" />
                        </div>
                        <div class="form-group">
                            <label for="prix">Prix unitaire : </label>
                            <div class="input-group">
                                <input class="form-control" type="text" name="prix" value="<?php echo $pr; ?>" placeholder="Saisir prix unitaire"/>
                                <span class="input-group-addon">$</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="prix">Quantité : </label>
                            <input class="form-control" type="text" name="quantite" value="<?php echo $qu; ?>" placeholder="Saisir quantité"/>
                        </div>
                        <div class="form-group">
                            <label for="description">Description : </label>
                            <textarea name="description" class="form-control"  rows="3" cols="15" value="<?php echo $des; ?>"></textarea>
                        </div>
                        <button class="btn btn-success" type="submit" name="submit">Ajouter article</button>
                    </form>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-9">
                    <?php echo "<br>"; ?>
                    <legend>Articles en stock...</legend>
                    <?php
                    include '../../model/functions.php';
                    $fieldNameArray = ['Article', 'Prix[$]', 'Quantité', 'Description', 'Action', '<a href="../journal/">Journal</a>'];
                    showProduit($fieldNameArray, 'denomination');
                    ?>
                </div>
            </div>

        </div>
        <script type="text/javascript" src="../../js/bootstrap.min.js"></script>
		  <script type="text/javascript" src="../../js/jquery.min.js"></script>
		  <script type="text/javascript" src="../../js/typeahead.min.js"></script>
		  <script type="text/javascript">
		  $(document).ready(function () {
			//Ajax saving
			$("#msg").show();
			$("#msg").delay(5000).fadeOut(300);
			//Ajax Search activation...
			$('input.typeahead').typeahead({
			  name: 'typeahead',
			  remote:'../../app/search/search.php?key=%QUERY',
			  limit : 10
			});
		  });
		  </script>
    </body>
</html>
