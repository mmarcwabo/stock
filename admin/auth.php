<?php

/* @var $data type */
$data = filter_input_array(INPUT_POST, $_POST);
if (isset($data['submit'])) {


    include_once '../control/functions.php';
    $user = cryptPw(htmlspecialchars($data['user']));
    $pass = cryptPw(htmlspecialchars($data['pass']));

    $cf = "../control/admin.ini";
    $login = (is_file($cf)) ? readIniParam($cf, "user") : "notadmin";
    $password = (is_file($cf)) ? readIniParam($cf, "pass") : "notadmin";
    if(!(($user=="") && ($pass==""))){
     if ($user == $login) {
        //echo "login ok<br>";
        if ($pass == $password) {
            //echo "pass ok<br>";
            //demarage de la session : besoin d'y garder quelques petites données
            session_start();
            $_SESSION['adminUn'] = "Admin Stock";
            header("Location:../view/vendeur/addVendeur.php?");
        } else {
            $msg = "<p style='color:red'>Echec des connexion...mot de passe incorrect...</p>";
            header("Location:admin.php?param=" . $msg);
        }
    } else {
        $msg = "<p style='color:red'>Echec des connexion...user inexistant...</p>";
            header("Location:admin.php?param=" . $msg);
    }   
    }else{
        $msg = "<p style='color:red'>Echec des connexion...champ(s) vide(s)...</p>";
            header("Location:admin.php?param=" . $msg);
    }
    
    
}

