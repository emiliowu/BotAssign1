<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of portfolioCollections
 * 
 * Model that contains the function to get collections data from the database
 *
 * @author Emilio
 */
class portfolioCollections extends MY_Model {

    function __construct() {
        parent::__construct('collections', 'piece');
    }

    public function getCollections($playerName, $piece) {
        $query = $this->db->query('SELECT Piece FROM collections'
                . ' WHERE Player = "' . $playerName . '" AND'
                . ' Piece = "' . $piece . '"');

        return $query->num_rows();
    }

}
