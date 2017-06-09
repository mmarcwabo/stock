<?php
include '../control/functions.php';
?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta   charset="utf-8"/>
        <title>Admin</title>
        <link rel="stylesheet" type="text/css" href="../css/bootstrap-theme.css" />
        <link rel="stylesheet" type="text/css" href="../css/bootstrap.css"/>
        <link rel="stylesheet" type="text/css" href="../css/style.css"/>
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
            <div class="row">
                <br><br>
                <div class="col-lg-4">
            <legend>Login</legend>
            <span id="msg" class="box" style="background-color:white;">
                <?php echo (isset($_GET['param'])) ? $_GET['param'] : "<p style='color:green'>Connectez vous ici...</p>"; ?></span>

            <form action="auth.php" method="POST" role="form">
                <div class="form-group">
                    <input class="form-control" type="text" name="user" value="" placeholder="Saisir user"/>
                </div>
                <div class="form-group">
                    <input class="form-control" type="password" name="pass" value="" placeholder="Saisir mot de passe"/>
                </div>
                <input class="btn btn-success" type="submit" value="Connecter" name="submit"/>
            </form>
            </div>
        </div>
        <script type="text/javascript" src="../js/bootstrap.min.js"></script>
        <script type="text/javascript" src="../js/jquery.min.js"></script>
        <script type="text/javascript">
            $(document).ready(function () {
                //Ajax saving
                $("#msg").show();
                $("#msg").delay(5000).fadeOut(300);
            });
        </script>
    </body>
</html>