<?php
session_start();

include_once '../../control/functions.php';
checkSessionValidity();
?>
<html>
    <head>
        <meta charset="utf-8">
        <title>Journal des recettes</title>
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
            <div class="row">
                <br><br>
                <legend><h2>Journal : <?php echo date('d-m-Y'); ?></h2></legend>
                <span id="msg" class="box" style="background-color:white;">
                    <p ><h3 style='color: green'>Journal des opérations effectuées...</h3></p>    
                </span>
				<h3><span class="link link-primary"><a href="entree/index.php">Entrées</a></span></h3>
				<h3><span class="link link-primary"><a href="sortie/index.php">Sorties</a></span></h3>

            </div>
        </div>
        <script type="text/javascript" src="../../../js/bootstrap.min.js"></script>
        <script type="text/javascript" src="../../../js/jquery.min.js"></script>
        <script type="text/javascript">
            $(document).ready(function () {
                //Ajax saving
                $("#msg").show();
                $("#msg").delay(5000).fadeOut(300);
            });
        </script>
    </body>  
</html>
