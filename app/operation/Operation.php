<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Operation
 *
 * @author Marcellin DBFX
 */
class Operation {
    //put your code here
    private $date;
    private $quantite;
    private $idVendeur;
    private $idProduit;
    private $isEntree;
    
    function __construct($date, $quantite, $idVendeur, $idProduit, $isEntree) {
        $this->date = $date;
        $this->quantite = $quantite;
        $this->idVendeur = $idVendeur;
        $this->idProduit = $idProduit;
        $this->isEntree = $isEntree;
    }
    
    function getDate() {
        return $this->date;
    }

    function getQuantite() {
        return $this->quantite;
    }

    function getIdVendeur() {
        return $this->idVendeur;
    }

    function getIdProduit() {
        return $this->idProduit;
    }

    function getIsEntree() {
        return $this->isEntree;
    }

    function setDate($date) {
        $this->date = $date;
    }

    function setQuantite($quantite) {
        $this->quantite = $quantite;
    }

    function setIdVendeur($idVendeur) {
        $this->idVendeur = $idVendeur;
    }

    function setIdProduit($idProduit) {
        $this->idProduit = $idProduit;
    }

    function setIsEntree($isEntree) {
        $this->isEntree = $isEntree;
    }




}

