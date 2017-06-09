<?php

session_start();
$data = filter_input_array(INPUT_POST, $_POST);
if (isset($data['submit'])) {
    $date = date('Y-m-d');
    $quantite = htmlspecialchars($data['quantite']);
    $denominationProduit = htmlspecialchars($data['denominationProduit']);
    $isEntree = ($data['type'] == "E") ? "OUI" : "NON";

    include_once '../model/functions.php';
    $idProduit = getFieldFromAnyElse("produit", "denomination", $denominationProduit, "idproduit");
    
    if ($quantite < 1) {
        $msg = "<p style='color:red; padding:0;'>Quantité invalide...</p>";
        header("Location:../view/operation/addOperation.php?param=" . $msg."&idproduit=".$idProduit);
        exit();
    }
    
    include_once '../app/operation/Operation.php';

    $idvendeur = getFieldFromAnyElse("vendeur", "nom", $_SESSION['name'], "idvendeur");
    $operation = new Operation($date, $quantite, $idvendeur, $idProduit, $isEntree);

    addOperation($operation);

    //Let's update the stock...
    $oldQte = getFieldFromAnyElse("stock", "produit_idproduit", $idProduit, "qtestockee");
    $newQte = $oldQte;
    if ($isEntree == "OUI") {
        $newQte = $newQte + $quantite;
    } else {
        if ($newQte > 0 && $quantite <= $oldQte) {
            $newQte = $newQte - $quantite;
        }
    }
    include_once '../app/stock/Stock.php';
    $stock = new Stock($newQte, date('Y-m-d'), $idProduit);
    addStock($stock, "old");

    $msg = "<p style='color:green; padding:0;'>Stock mis à jour...</p>";
    header("Location:../view/produit/addProduit.php?param=" . $msg);
}

