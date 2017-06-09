<?php
session_start();

include_once '../../control/functions.php';
checkSessionValidity();
?>
<html>
    <head>
        <meta charset="utf-8">
        <title>Archives - Journal</title>
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
            <div class="row">
                <br/><br/><a href="index.php">Ventes du jour</a>
                <legend>Selectionnez une date : </legend>
                <span id="msg" class="box" style="background-color:white;">
                    <p style='color: green'>Ventes ulterieurement effectuées...</p>    
                </span>
                <div class="col-lg-3">
                    <ul class="list-unstyled">
                        <?php
                        include '../../model/functions.php';
                        $datesArray = showDates();
                        $dates = [];
                        foreach ($datesArray as $d) {
                            $dates[] = $d[0];
                        }
                        $dates = array_unique($dates);
                        foreach ($dates as $d) {
                            ?>
                            <li><a href="archives.php?date=<?php echo $d; ?>"><?php echo $d; ?></a></li>
                            <?php
                        }
                        ?>
                    </ul>
                </div>
                <?php if (isset($_GET['date'])) { ?>
                    <div class="col-lg-9">
                        <?php
                        $date=$_GET['date'];
                        $fieldNameArray = ['ID Journal', 'Libellé', 'Quantité', 'PU', 'Description', 'PT', '<a href="../produit/addProduit.php">Retour</a>'];
                        showArchive($date, $fieldNameArray, "denomination"); 
                        ?>
                    </div>
                <?php } ?>
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
