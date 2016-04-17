<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of portfolioBuy
 * Model that contains the function to get buy data from the database
 *
 * @author Emilio
 */
class portfolioBuy extends MY_Model {

    function __construct() {
        parent::__construct();
    }

    public function updateCollections($playerName, $piece, $cToken) {
        $datetime = date('Y.m.d-H:i:s');

        /* $query = $this->db->query('INSERT INTO collections (Token, Piece, '
          . 'Player, Datetime) VALUES ("' . $cToken . '", "' . $piece . '", "'
          . $playerName . '", "' . $datetime . '")'); */

        //$this->updateTransactions($playerName, $datetime);
        $this->payment($playerName);


        //return $query->result();
    }

    public function updateTransactions($playerName) {
        $series = 'x';
        $trans = 'buy';
        $datetime = date('Y.m.d-H:i:s');

        $query = $this->db->query('INSERT INTO transactions (Datetime, Player, '
                . 'Series, Trans) VALUES ("' . $datetime . '", "' . $playerName . '", "'
                . $series . '", "' . $trans . '")');
    }

    public function payment($playerName) {
        $fund = $this->getCash($playerName);

        $query = $this->db->query('UPDATE players'
                . ' SET Peanuts = "' . $fund . '"'
                . ' WHERE Player = "' . $playerName . '"');

        //return $query2->result();
    }

    public function getCash($playerName) {
        $query = $this->db->query('SELECT Peanuts FROM players WHERE Player = "'
                        . $playerName . '"')->result_array();

        $fund = ($query[0]['Peanuts'] - 2);
        
        return $fund;
    }

}
