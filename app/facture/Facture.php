<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Facture
 *
 * @author Marcellin DBFX
 */
class Facture {
    //put your code here
    private $numero;
    private $operationIdOperation;
    private $operationIdVendeur;
    private $operationIdProduit;
    
    function __construct($numero, $operationIdOperation, $operationIdVendeur, $operationIdProduit) {
        $this->numero = $numero;
        $this->operationIdOperation = $operationIdOperation;
        $this->operationIdVendeur = $operationIdVendeur;
        $this->operationIdProduit = $operationIdProduit;
    }
    
    function getNumero() {
        return $this->numero;
    }

    function getOperationIdOperation() {
        return $this->operationIdOperation;
    }

    function getOperationIdVendeur() {
        return $this->operationIdVendeur;
    }

    function getOperationIdProduit() {
        return $this->operationIdProduit;
    }

    function setNumero($numero) {
        $this->numero = $numero;
    }

    function setOperationIdOperation($operationIdOperation) {
        $this->operationIdOperation = $operationIdOperation;
    }

    function setOperationIdVendeur($operationIdVendeur) {
        $this->operationIdVendeur = $operationIdVendeur;
    }

    function setOperationIdProduit($operationIdProduit) {
        $this->operationIdProduit = $operationIdProduit;
    }



}
