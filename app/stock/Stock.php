<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Stock
 *
 * @author Marcellin DBFX
 */
class Stock {
    //put your code here
    private $qteStockee;
    private $date;
    private $produitIdProduit;
    
    function __construct($qteStockee, $date, $produitIdProduit) {
        $this->qteStockee = $qteStockee;
        $this->date = $date;
        $this->produitIdProduit = $produitIdProduit;
    }
    
    function getQteStockee() {
        return $this->qteStockee;
    }

    function getDate() {
        return $this->date;
    }

    function getProduitIdProduit() {
        return $this->produitIdProduit;
    }

    function setQteStockee($qteStockee) {
        $this->qteStockee = $qteStockee;
    }

    function setDate($date) {
        $this->date = $date;
    }

    function setProduitIdProduit($produitIdProduit) {
        $this->produitIdProduit = $produitIdProduit;
    }


}
