<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Vendeur
 *
 * @author Marcellin DBFX
 */
class Vendeur {
    //put your code here
    private $nom;
    private $user;
    private $pass;
    
    function __construct($nom, $user, $pass) {
        $this->nom = $nom;
        $this->user = $user;
        $this->pass = $pass;
    }
    
    function getNom() {
        return $this->nom;
    }

    function getUser() {
        return $this->user;
    }

    function getPass() {
        return $this->pass;
    }

    function setNom($nom) {
        $this->nom = $nom;
    }

    function setUser($user) {
        $this->user = $user;
    }

    function setPass($pass) {
        $this->pass = $pass;
    }

    

}
