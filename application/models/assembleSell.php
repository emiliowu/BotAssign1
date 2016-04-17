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
class assembleSell extends MY_Model {

    function __construct() {
        parent::__construct();
    }

    public function updateCollections($playerName, $topToken, $midToken, $botToken) {
        $datetime = date('Y.m.d-H:i:s');

        $query = $this->db->query('DELETE FROM collections WHERE Token = "' 
                . $topToken . '"Player = "' . $playerName . '" AND Token = "' 
                . $midToken . '" AND Token = "' . $botToken . '"');

        $this->updateTransactions($playerName, $datetime);
        $this->payment($playerName, $balance);

        //return $query->result();
    }

    public function updateTransactions($playerName) {
        $series = 'x';
        $trans = 'sell';
        $datetime = date('Y.m.d-H:i:s');

        $query = $this->db->query('INSERT INTO transactions (Datetime, Player, '
                . 'Series, Trans) VALUES ("' . $datetime . '", "' . $playerName . '", "'
                . $series . '", "' . $trans . '")');
    }

    public function payment($playerName, $fund) {
        //$fund = $this->getCash($playerName);

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
