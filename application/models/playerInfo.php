<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of PlayerInfo
 *
 * @author Khang
 */
class playerInfo extends MY_Model {
    
    function __construct() {
        parent::__construct();
        $this->tablename = 'players';
        $this->keyfield = 'Player'; 
    }
    
     /**
     * Return the player's name, the amt of peanuts they have, and the amount 
      * of bot cards each player has 
     */
    
    public function playerEC(){
        $query = $this->db->query('SELECT players.Player, players.Peanuts, '
                . 'count(Piece) AS Total_Pieces FROM `collections` INNER JOIN players '
                . 'ON collections.Player = players.Player GROUP BY players.Player');
      
        return $query->result();  
    }

}
