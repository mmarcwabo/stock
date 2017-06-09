<?php

$data = filter_input_array(INPUT_POST, $_POST);
if (isset($data['submit'])) {
    $nom = htmlspecialchars($data['nom']);
    $user = htmlspecialchars($data['user']);
    $pass = htmlspecialchars($data['pass']);
    $idvendeur = $_GET['idvendeur'];
    include_once '../model/functions.php';
    if ($_GET['action'] == "delete") {
        deleteVendeur($idvendeur);
        $msg = "<p style='color:red; padding:0;'>Vendeur supprimé...</p>";
        header("Location:../view/vendeur/addVendeur.php?param=" . $msg);
        exit;
    }
    if ($user != "") {
        if ($pass != "") {
            include_once '../control/functions.php';
            $pass = cryptPw(htmlspecialchars($data['pass']));
            if ($nom != "") {

                include_once '../app/vendeur/Vendeur.php';

                $vendeur = new Vendeur($nom, $user, $pass);

                if ($_GET['action'] == "edit") {
                    applyEditVendeur($vendeur, $idvendeur);
                    $msg = "<p style='color:green; padding:0;'>Vendeur modifiée...</p>";
                    header("Location:../view/vendeur/addVendeur.php?param=" . $msg);
                    exit;
                }
                addVendeur($vendeur);
                $msg = "<p style='color:green'>Vendeur ajouté...</p>";
                header("Location:../view/vendeur/addVendeur.php?param=" . $msg);
            } else {

                $msg = "<p style='color:red'>Le vendeur doit avoir un nom...</p>";
                header("Location:../view/vendeur/addVendeur.php?param=" . $msg);
            }
        } else {
            $msg = "<p style='color:red'>Le vendeur doit avoir un mot de passe...</p>";
            header("Location:../view/vendeur/addVendeur.php?param=" . $msg);
        }
    } else {
        $msg = "<p style='color:red'>Le vendeur doit avoir un nom d'utilisateur...</p>";
        header("Location:../view/vendeur/addVendeur.php?param=" . $msg);
    }
} else {
    $msg = "<p style='color:red'>Erreur...</p>";
    header("Location:admin.php?param=" . $msg);
}

    


