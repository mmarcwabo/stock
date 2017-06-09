<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Rapport
 *
 * @author Marcellin DBFX
 */
class Rapport {
    //put your code here
    private $date;
    private $factIdFacture;
    private $factOpeIdOperation;
    private $factOpeVenIdVendeur;
    private $factOpProdIdProduit;
    
    function __construct($date, $factIdFacture, $factOpeIdOperation, $factOpeVenIdVendeur, $factOpProdIdProduit) {
        $this->date = $date;
        $this->factIdFacture = $factIdFacture;
        $this->factOpeIdOperation = $factOpeIdOperation;
        $this->factOpeVenIdVendeur = $factOpeVenIdVendeur;
        $this->factOpProdIdProduit = $factOpProdIdProduit;
    }
    
    function getDate() {
        return $this->date;
    }

    function getFactIdFacture() {
        return $this->factIdFacture;
    }

    function getFactOpeIdOperation() {
        return $this->factOpeIdOperation;
    }

    function getFactOpeVenIdVendeur() {
        return $this->factOpeVenIdVendeur;
    }

    function getFactOpProdIdProduit() {
        return $this->factOpProdIdProduit;
    }

    function setDate($date) {
        $this->date = $date;
    }

    function setFactIdFacture($factIdFacture) {
        $this->factIdFacture = $factIdFacture;
    }

    function setFactOpeIdOperation($factOpeIdOperation) {
        $this->factOpeIdOperation = $factOpeIdOperation;
    }

    function setFactOpeVenIdVendeur($factOpeVenIdVendeur) {
        $this->factOpeVenIdVendeur = $factOpeVenIdVendeur;
    }

    function setFactOpProdIdProduit($factOpProdIdProduit) {
        $this->factOpProdIdProduit = $factOpProdIdProduit;
    }



}
