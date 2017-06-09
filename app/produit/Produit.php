<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Produit
 *
 * @author Marcellin DBFX
 */
class Produit {
    //put your code here
    private $denomination;
    private $prix;
    private $description;
    
    function __construct($denomination, $prix, $description) {
        $this->denomination = $denomination;
        $this->prix = $prix;
        $this->description = $description;
    }
    
    function getDenomination() {
        return $this->denomination;
    }

    function getPrix() {
        return $this->prix;
    }

    function getDescription() {
        return $this->description;
    }

    function setDenomination($denomination) {
        $this->denomination = $denomination;
    }

    function setPrix($prix) {
        $this->prix = $prix;
    }

    function setDescription($description) {
        $this->description = $description;
    }



}
