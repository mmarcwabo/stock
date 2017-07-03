<?php

//Fonction de cryptage personnalisée, pour les mots de passes
//Il reçoit le mot de passe en paramètre
function cryptPw($pw) {
    return sha1(md5(sha1($pw)));
}

//Verifie si l'utilisateur est connecté, et le fout dehors s'il ne l'est pas,
//en cas de tentative d'accès sans authentification
function checkSessionValidity() {
    if (!(isset($_SESSION['name']))) {
        header('Location:../../index.php');
    }
}

//Les identifiants de l'administrateur du système sont sotckés dans un fichier ini...
//Cette fonction permet de les obtenir...
//Paramètres : $cf : chemin du fichier ini, $ip : paramètre dont on veut recuperer la valeur
function readIniParam($cf, $ip) {
    $a = parse_ini_file($cf);
    return $a[$ip];
}

//test si l'utilisateur en cours est un administrateur du systeme
function isAdmin() {
    if (!(isset($_SESSION['adminUn']))) {
        header('Location:../index.php');
    }
}

//Affiche un lien de deconnexion à l'application
function showExitLink($path) {
    return "<span class='link link-danger'><a href='" . $path . "index.php'>X</a></span>";
}
