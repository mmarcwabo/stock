<?php
//Appel des fonctions 
include_once '../model/functions.php';
include_once '../control/functions.php';

$user=$_POST['user'];
$pass=$_POST['pass'];
validerMembre($user, $pass);

