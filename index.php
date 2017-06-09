<?php
session_start();
include_once 'control/functions.php';
session_destroy();
?>
<html>
    <head>
        <meta charset="utf-8">
        <title>Connexion</title>
        <link rel="stylesheet" type="text/css" href="css/bootstrap-theme.css" />
        <link rel="stylesheet" type="text/css" href="css/bootstrap.css"/>
        <link rel="stylesheet" type="text/css" href="css/style.css"/>
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
            <div class="row col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <br><br>
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-4">
                    <legend>Connexion</legend>
                    <span id="msg" class="box" style="background-color:white;">
                        <?php echo (isset($_GET['err'])) ? $_GET['err'] : "<p style='color:green'>Bienvenu...</p>"; ?></span>

                    <form role="form" method="POST" action="control/authVendeur.php">
                        <div class="form-group">
                            <label for="user">Nom d'utilisateur : </label>
                            <input class="form-control" type="text" name="user" placeholder="Saisir le nom d'utilisateur" />
                        </div>
                        <div class="form-group">
                            <label for="pass">Mot de passe : </label>
                            <input class="form-control" type="password" name="pass" placeholder="Saisir mot de passe"/><br/>
                        </div>
                        <input class="btn btn-success" type="submit" value="Connecter" name="submit" />
                    </form>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-8">
                    <img src="images/splash.png" class="img-responsive bordered">
                </div>
            </div>
        </div>
        <script type="text/javascript" src="js/bootstrap.min.js"></script>
        <script type="text/javascript" src="js/jquery.min.js"></script>
        <script type="text/javascript">
            $(document).ready(function () {
                //Ajax saving
                $("#msg").show();
                $("#msg").delay(5000).fadeOut(300);
            });
        </script>
    </body>  
</html>