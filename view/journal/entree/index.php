<?php
session_start();

include_once '../../../control/functions.php';
checkSessionValidity();
?>
<html>
    <head>
        <meta charset="utf-8">
        <title>Journal des recettes</title>
        <link rel="stylesheet" type="text/css" href="../../../css/bootstrap-theme.css" />
        <link rel="stylesheet" type="text/css" href="../../../css/bootstrap.css"/>
        <link rel="stylesheet" type="text/css" href="../../../css/style.css"/>
    </head>
    <body>
        <div class="container">
            <div class="top">
                <a href="../../produit/addProduit.php">
                    <strong>&laquo; Gestion des stock &laquo;</strong>
                </a>
                <span class="right">
                    <a href="#" target="_blank"></a>
                    <?php echo showExitLink("../../../"); ?>

                </span>

                <div class="clr"></div>
            </div>
            <div class="row">
                <br><br>
                <h3><span class="link link-primary"><a href="archives.php">Voir archives achats</a></span></h3>
                <legend>Journal : <?php echo date('d-m-Y'); ?></legend>
                <span id="msg" class="box" style="background-color:white;">
                    <p style='color: green'>Journal des achats effectués...</p>    
                </span>

                <?php
                
                include '../../../model/functions.php';
                $fieldNameArray = ['ID Journal', 'Article', 'Quantité', 'Description', 'PT', '<a href="../../produit/addProduit.php">Retour</a>'];
                showJournalS($fieldNameArray, 'denomination');
                ?>
            </div>
        </div>
        <script type="text/javascript" src="../../../js/bootstrap.min.js"></script>
        <script type="text/javascript" src="../../../js/jquery.min.js"></script>
    </body>  
</html>
