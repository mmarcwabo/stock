<?php

/*
 * Connexion à la base des données
 * $db : base des données
 * $user : nom d'utilisateur de la base des données
 * $password : mot de passe de l'utilisateur de la base
 * retourne un objet PDO de connexion
 */

function connectDb() {

    $host = "localhost";
    $db = "stock";
    $url = "mysql:host=" . $host;
    $url .= ";dbname=" . $db;

    $user = "root";
    $pass = "";
    //Connexion PDO à la BD
    try {
        $databaseConnection = new PDO($url, $user, $pass);
        $databaseConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        echo 'ERREUR: ' . $e->getMessage();
    }
    return $databaseConnection;
}

#CRUD
/* Vendeurs */

//Add
function addVendeur($vendeur) {
    $iQuery = "INSERT INTO vendeur (nom, user, pass) VALUES(:nom, :user, :pass);";
    $dbCon = connectDb();
    $req = $dbCon->prepare($iQuery);
    $req->execute(array(
        'nom' => $vendeur->getNom(),
        'user' => $vendeur->getUser(),
        'pass' => $vendeur->getPass()
    ));
    $req->closeCursor();
}

//Show
function showVendeur($fieldNameArray, $link) {
    $sQuery = "SELECT * FROM vendeur WHERE ?";
    $dbCon = connectDb();
    $pQuery = $dbCon->prepare($sQuery);
    $pQuery->execute(array(1));

    $fieldArray = ['idvendeur', 'nom', 'user'];

    echo '<table class="table table-striped table-responsive">';
    foreach ($fieldNameArray as $field) {
        echo '<th class="active">' . $field . '</th>';
    }
    while ($data = $pQuery->fetch()) {

        echo '<tr>';
        foreach ($fieldArray as $field) {

            if ($data[$field] == $data[$link]) {
                $addLeftLinkTag = '<a href="../vendeur/details.php?idvendeur=';
                $addLeftLinkTag .= $data['idvendeur'];
                $idvendeur = $data['idvendeur'];
                $addLeftLinkTag .= '">';
                $addRightLinkTag = '</a>';
                $Link = "";
                $Link .= $addLeftLinkTag;
                $Link .= $data[$field];
                $Link .= $addRightLinkTag;
                echo "<td>" . $Link . "</td>";
            } else {
                echo '<td>' . $data[$field] . '</td>';
            }
        }
        echo '<td><span class="link link-primary"><a href="editVendeur.php?idvendeur=' . $idvendeur . '">Modifier</a></span><span class="link link-danger"><a href="deleteVendeur.php?idvendeur=' . $idvendeur . '">Supprimer</a></span></td></tr>';
    }
    echo '</table>';
}

//Edit
function editVendeur($idvendeur) {

    $sQuery = "SELECT * FROM vendeur WHERE idvendeur = ?";
    $dbCon = connectDb();
    $req = $dbCon->prepare($sQuery);
    $req->execute(array($idvendeur));
    $result = $req->fetch();
    if ($req->rowCount() > 0) {
        return $result;
    } else {
        return "Erreur lors de la modification du produit";
    }
}

//Writing the edit action to database
function applyEditVendeur($vendeur, $idvendeur) {
    $uQuery = "UPDATE vendeur SET nom=?, user=?, pass=? WHERE idvendeur =" . $idvendeur;
    $dbCon = connectDb();
    $req = $dbCon->prepare($uQuery);
    $req->execute(array(
        $vendeur->getNom(),
        $vendeur->getUser(),
        $vendeur->getPass()
    ));
    $req->closeCursor();
}

//Delete vendeur
function deleteVendeur($idvendeur) {

    $dQuery = "DELETE FROM vendeur WHERE idvendeur = ? ";
    $dbCon = connectDb();
    $req = $dbCon->prepare($dQuery);
    $req->execute(array($idvendeur));
    $req->closeCursor();
}

//--------------------------------------------------------------------------------------------------
/* Produit */

//Add
function addProduit($produit) {
    $iQuery = "INSERT INTO produit (denomination, prix, description) VALUES(:denomination, :prix, :description);";
    $dbCon = connectDb();
    $req = $dbCon->prepare($iQuery);
    $req->execute(array(
        'denomination' => $produit->getDenomination(),
        'prix' => $produit->getPrix(),
        'description' => $produit->getDescription()
    ));
    $req->closeCursor();
    echo "<script type='text/javascript'>alert('Succes')</script>";
}

//Show
//Affichage et formattage des données
function showProduit($fieldNameArray, $link) {
    $sQuery = "SELECT * FROM produit,stock WHERE produit.idproduit = stock.produit_idproduit AND ?";
    $dbCon = connectDb();
    $pQuery = $dbCon->prepare($sQuery);
    $pQuery->execute(array(1));

    $fieldArray = ['denomination', 'prix', 'qtestockee', 'description'];

    echo '<table class="table table-hover table-responsive">';
    echo '<thead>';
    foreach ($fieldNameArray as $field) {
        echo '<th class="active">' . $field . '</th>';
    }
    echo '</thead><tbody>';
    while ($data = $pQuery->fetch()) {

        echo '<tr>';
        foreach ($fieldArray as $field) {

            if ($data[$field] == $data[$link]) {
                $addLeftLinkTag = '<a href="../produit/details.php?idProduit=';
                $addLeftLinkTag .= $data['idproduit'];
                $idproduit = $data['idproduit'];
                $addLeftLinkTag .= '">';
                $addRightLinkTag = '</a>';
                $Link = "";
                $Link .= $addLeftLinkTag;
                $Link .= $data[$field];
                $Link .= $addRightLinkTag;
                echo "<td>" . $Link . "</td>";
            } else {
                echo '<td>' . $data[$field] . '</td>';
            }
        }
        echo '<td><span class="link link-success"><a href="../operation/addOperation.php?idproduit=' . $idproduit . '">Gérer</a></span><span class="link link-primary"><a href="editProduit.php?idproduit=' . $idproduit . '">Modif.</a></span><span class="link link-danger"><a href="deleteProduit.php?idproduit=' . $idproduit . '">Suppr.</a></span></td></tr>';
    }
    echo '</tbody></table>';
}

//edit
function editProduit($idproduit) {

    $sQuery = "SELECT * FROM produit, stock WHERE idproduit=produit_idproduit AND idproduit = ?";
    $dbCon = connectDb();
    $req = $dbCon->prepare($sQuery);
    $req->execute(array($idproduit));
    $result = $req->fetch();
    if ($req->rowCount() > 0) {
        return $result;
    } else {
        return "Erreur lors de la modification du produit";
    }
}

//Applying edit effect
function applyEditProduit($produit, $idproduit) {

    $uQuery = "UPDATE produit SET denomination=?, prix=?, description=? WHERE idproduit =" . $idproduit;
    $dbCon = connectDb();
    $req = $dbCon->prepare($uQuery);
    $req->execute(array(
        $produit->getDenomination(),
        $produit->getPrix(),
        $produit->getDescription()
    ));
    $req->closeCursor();
}

//delete
function deleteProduit($idproduit) {

    $dQuery = "DELETE FROM produit WHERE idproduit = ? ";
    $dbCon = connectDb();
    $req = $dbCon->prepare($dQuery);
    $req->execute(array($idproduit));
    $req->closeCursor();
}

//--------------------------------------------------------------------------------------------------
/* Operation */

//Add
function addOperation($operation) {
    $iQuery = "INSERT INTO operation (type, quantite, vendeur_idvendeur, produit_idproduit) VALUES(:type, :quantite, :vendeur_idvendeur, :produit_idproduit);";
    $dbCon = connectDb();
    $req = $dbCon->prepare($iQuery);
    $type = ($operation->getIsEntree() == "OUI") ? "entree" : "sortie";
    $req->execute(array(
        'type' => $type,
        'quantite' => $operation->getQuantite(),
        'vendeur_idvendeur' => $operation->getIdVendeur(),
        'produit_idproduit' => $operation->getIdProduit()
    ));
    $req->closeCursor();
}

//Stock
//Add
/*
  Insertion dans le stock des produit...
 * le parametre $status est boolean, new ou old sont ses valeurs possibles
 * new dans le cas d'un nouveau produit...et old dans le cas d'un produit existant
 * déjà, mais dont on voudrait augmenter la quantité...
 *  */
function addStock($stock, $status) {
    if ($status === "new") {
        $iQuery = "INSERT INTO stock(qtestockee, produit_idproduit) VALUES(:qtestockee, :produit_idproduit)";
        $dbCon = connectDb();
        $req = $dbCon->prepare($iQuery);
        $req->execute(array(
            'qtestockee' => $stock->getQteStockee(),
            'produit_idproduit' => $stock->getProduitIdProduit()
        ));
        $req->closeCursor();
        echo "<script type='text/javascript'>alert('Succes')</script>";
    } else {
        $iQuery = "UPDATE stock SET qtestockee = :qtestockee WHERE produit_idproduit = " . $stock->getProduitIdProduit();
        $dbCon = connectDb();
        $req = $dbCon->prepare($iQuery);
        $req->execute(array(
            'qtestockee' => $stock->getQteStockee(),
        ));
        $req->closeCursor();
    }
}

//Journalisation opération
function journaliserOperation() {
    
}

//Get an element by any else
function getFieldFromAnyElse($table, $fwhName, $fwh, $ftg) {

    $sQuery = "SELECT " . $ftg;
    $sQuery .= " FROM " . $table;
    $sQuery .= " WHERE " . $fwhName;
    $sQuery .= " =? ";

    $dbCon = connectDb();
    $pQuery = $dbCon->prepare($sQuery);
    $pQuery->execute(array($fwh));

    $resultSet = $pQuery->fetch();

    return $resultSet[$ftg];
}

//Verifie l'existance
function verifierExistanceKey($table, $field, $keyValue) {

    $sQuery = "SELECT *";
    $sQuery .= " FROM " . $table;
    $sQuery .= " WHERE " . $field . "=?";

    $compteur = 0;
    $databaseConnection = connectDb();
    $result = $databaseConnection->prepare($sQuery);
    $result->execute(array($keyValue));
    $compteur = $result->rowCount();
    $result->closeCursor();
    return $compteur;
}

//Authentifier membre
function validerMembre($user, $pass) {
    $errMsg = '';
    if (isset($user) && isset($pass)) {
        $user = trim($user);
        $pass = trim($pass);
        if ($user == '') {
            $errMsg .= "<p style='color:red'>Vous devez avoir un login</p>";
        }
        if ($pass == '') {
            $errMsg .= "<p style='color:red'>Vous devez avoir un mot de passe</p>";
        }
        if ($errMsg == '') {
            $dbCon = connectDb();
            $sQuery = "SELECT * ";
            $sQuery .= "FROM vendeur ";
            $sQuery .= "WHERE user=:username";

            $records = $dbCon->prepare($sQuery);
            $records->bindParam(':username', $user);
            $records->execute();
            $results = $records->fetch(PDO::FETCH_ASSOC);
            if (count($results) > 0 && cryptPw($pass) == $results['pass']) {
                session_start();
                $_SESSION['name'] = $results['nom'];
                $_SESSION['user'] = $results['user'];
                header('Location:../view/produit/addProduit.php');
                exit;
            } else {
                $errMsg .= "<p style='color:red'>Utilisateur non existant</p>";
                header('Location:../index.php?err=' . $errMsg);
                exit;
            }
        }
        header('Location:../index.php?err=' . $errMsg);
        exit;
    }
}

//Show
//Show
//Affichage et formattage des données
function showJournal($fieldNameArray, $link) {
    $sQuery = "SELECT * FROM produit,stock, operation WHERE produit.idproduit = stock.produit_idproduit AND produit.idproduit = operation.produit_idproduit AND DATE_FORMAT(operation.date, '%Y-%m-%d')=? AND operation.type = ?";
    $numRow = 1;
    $total = 0;
    $dbCon = connectDb();
    $pQuery = $dbCon->prepare($sQuery);
    $pQuery->execute(array(date('Y-m-d'), "sortie"));

    $fieldArray = ['denomination', 'quantite', 'prix', 'description'];
    if ($pQuery->rowCount() < 1) {
        echo "Aucune vente effectuée...";
        exit;
    }
    echo '<table class="table table-striped">';
    foreach ($fieldNameArray as $field) {
        echo '<th>' . $field . '</th>';
    }
    while ($data = $pQuery->fetch()) {

        echo '<tr>';
        echo '<td>' . $numRow . '</td>';
        foreach ($fieldArray as $field) {

            if ($data[$field] == $data[$link]) {
                $addLeftLinkTag = '<a href="../produit/details.php?idProduit=';
                $addLeftLinkTag .= $data['idproduit'];
                ///$idproduit = $data['idproduit'];
                $addLeftLinkTag .= '">';
                $addRightLinkTag = '</a>';
                $Link = "";
                $Link .= $addLeftLinkTag;
                $Link .= $data[$field];
                $Link .= $addRightLinkTag;
                echo "<td>" . $Link . "</td>";
            } else {
                echo '<td>' . $data[$field] . '</td>';
            }
        }
        echo '<td>' . $data['quantite'] * $data['prix'] . '</td></tr>';
        $numRow++;
        $total += $data['quantite'] * $data['prix'];
    }

    echo '<tr><td>Total recettes :</td><td><td></td><td></td><td></td></td><td>' . $total . '</td></tr>';
    echo '</table>';
}

//Archives
//Show
function showDates() {
    $sQuery = "SELECT DATE_FORMAT(date, 'Le %d-%m-%Y') AS d from operation";

    $dbCon = connectDb();
    $req = $dbCon->prepare($sQuery);
    $req->execute();
    $resultSet = $req->fetchAll();
    if ($req->rowCount() > 0) {
        return $resultSet;
    } else {
        return "Aucune date ulterieure de vente";
    }
}

//Sililaire à showJournal...
function showArchive($date, $fieldNameArray, $link) {
    $sQuery = "SELECT * FROM produit,stock, operation WHERE produit.idproduit = stock.produit_idproduit AND produit.idproduit = operation.produit_idproduit AND DATE_FORMAT(operation.date, 'Le %d-%m-%Y')= ? AND operation.type = ?";
    $numRow = 1;
    $total = 0;
    $dbCon = connectDb();
    $pQuery = $dbCon->prepare($sQuery);
    $pQuery->execute(array($date ,"sortie"));

    $fieldArray = ['denomination', 'quantite', 'prix', 'description'];
    if ($pQuery->rowCount() < 1) {
        echo "Aucune vente effectuée...";
        exit;
    }
    echo "<legend>Ventes effectuée ".$date."</legend>";
    echo '<table class="table table-striped table-responsive">';
    foreach ($fieldNameArray as $field) {
        echo '<th>' . $field . '</th>';
    }
    while ($data = $pQuery->fetch()) {

        echo '<tr>';
        echo '<td>' . $numRow . '</td>';
        foreach ($fieldArray as $field) {

            if ($data[$field] == $data[$link]) {
                $addLeftLinkTag = '<a href="../produit/details.php?idProduit=';
                $addLeftLinkTag .= $data['idproduit'];
                ///$idproduit = $data['idproduit'];
                $addLeftLinkTag .= '">';
                $addRightLinkTag = '</a>';
                $Link = "";
                $Link .= $addLeftLinkTag;
                $Link .= $data[$field];
                $Link .= $addRightLinkTag;
                echo "<td>" . $Link . "</td>";
            } else {
                echo '<td>' . $data[$field] . '</td>';
            }
        }
        echo '<td>' . $data['quantite'] * $data['prix'] . '</td></tr>';
        $numRow++;
        $total += $data['quantite'] * $data['prix'];
    }

    echo '<tr><td>Total recettes :</td><td><td></td><td></td><td></td></td><td>' . $total . '</td></tr>';
    echo '</table>';
}
