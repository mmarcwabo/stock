<?php
session_start();
include_once '../control/functions.php';
checkSessionValidity();
header('Location:produit/addProduit.php');


