<?php
session_start();
include_once '../../control/functions.php';
isAdmin();
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
                    <br/>
                    <?php echo showExitLink("../../"); ?>
                    <legend>Ajouter vendeur</legend>
                    <span id="msg" class="box" style="background-color:white;">
                        <?php echo (isset($_GET['param'])) ? $_GET['param'] : "<p style='color:green'>Gerez les vendeurs ici</p>"; ?></span>
                    <form  role="form" method="POST" action="../../control/vendeur.php">
                        <input class="form-control" type="text" name="nom" value="" placeholder="Saisir nom" /><br/>
                        <input class="form-control"  type="text" name="user" value="" placeholder="Saisir user"/><br/>
                        <input  class="form-control" type="password" name="pass" value="" placeholder="Saisir mot de pass" /><br/>
                        <input class="btn btn-success" type="submit" value="Ajouter vendeur" name="submit" />
                    </form>
                </div>
                <div class="col-lg-9">
                    <br/><br/>
                    <legend>Vendeurs enregistrée...</legend>
                    <?php
                    include_once '../../model/functions.php';
                    $fieldNameArray = ['ID Vendeur', 'Nom', 'User'];
                    showVendeur($fieldNameArray, 'nom');
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