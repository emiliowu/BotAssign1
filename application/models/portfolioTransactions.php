<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of portfolioTransactions
 * Model that contains the function to get transactions data from the database
 *
 * @author Emilio
 */
class portfolioTransactions extends MY_Model {

    function __construct() {
        parent::__construct('transactions', 'player');
    }

    public function get_transactions($playerName) {
        $query = $this->db->query('SELECT DateTime, Series, Trans '
                . 'FROM transactions WHERE Player = "' . $playerName
                . '" ORDER BY Datetime DESC LIMIT 5');

        return $query->result();
    }

}
