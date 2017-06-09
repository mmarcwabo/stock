<?php

$data = filter_input_array(INPUT_POST, $_POST);
if (isset($data['submit'])) {
//Appel des fonctions CRUD sur la base des données [add, show, edit, del y sont definies...}
    include_once '../model/functions.php';
    $idproduit = $_GET['idproduit'];
    //Si nous mettions la suppression après add et edit, nous ne la fairons jamais,
    //Pour la suppression, nous n'avons besoin que de l'id du produit
    if (($_GET['action'] == "delete")) {
        deleteProduit($idproduit);
        $msg = "<p style='color:red; padding:0;'>Produit supprimé...</p>";
        header("Location:../view/produit/addProduit.php?param=" . $msg);
        exit;
    }

    if ($data['denomination'] == "" || $data['prix'] == "" || $data['description'] == "") {
        $msg = "<p style='color:red; padding:0;'>Completez les champs vides...</p>";
        header("Location:../view/produit/addProduit.php?param=" . $msg . "&den=" . $data['denomination'] . "&pr=" . $data['prix'] . "&des=" . $data['description'] . "&qu=" . $data['quantite']);
        exit;
    }
//Récuperation des données envoyée par formulaire
    $denomination = htmlspecialchars($data['denomination']);
    $prix = htmlspecialchars($data['prix']);
    $description = htmlspecialchars($data['description']);
    $quantite = 0;
    //la classe produit
    include_once '../app/produit/Produit.php';
    $produit = new Produit($denomination, $prix, $description);


    //Actions : ajout, modification & Suppression
    if ($_GET['action'] == "add") {
        if (!($data['quantite'] == "")) {
            $quantite = htmlspecialchars($data['quantite']);
        } else {
            $msg = "<p style='color:red; padding:0;'>Completez les champs vides...</p>";
            header("Location:../view/produit/addProduit.php?param=" . $msg . "&den=" . $data['denomination'] . "&pr=" . $data['prix'] . "&des=" . $data['description'] . "&qu=" . $data['quantite']);
            exit;
        }

        if (verifierExistanceKey("produit", "denomination", $denomination) > 0) {
            $msg = "<p style='color:red; padding:0;'>Ce produit est déjà dans le stock...</p>";
            header("Location:../view/produit/addProduit.php?param=" . $msg);
            exit;
        }
        addProduit($produit);
        //récuperation du produit juste ajouté, pour le stocker dans le stock...
        $produitIdProduit = getFieldFromAnyElse("produit", "denomination", $denomination, "idproduit");
        include_once '../app/stock/Stock.php';
        $stock = new Stock($quantite, date('Y-m-d'), $produitIdProduit);
        addStock($stock, "new");
        $msg = "<p style='color:green; padding:0;'>Produit ajouté, stock mis à jour...</p>";
        header("Location:../view/produit/addProduit.php?param=" . $msg);
    } elseif ($_GET['action'] == "edit") {

        applyEditProduit($produit, $idproduit);
        $msg = "<p style='color:green; padding:0;'>Produit modifiée...</p>";
        header("Location:../view/produit/addProduit.php?param=" . $msg);
    }
}





