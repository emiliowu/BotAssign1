<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of gameStatus
 *
 * @author Anderson
 */
class gameStatus extends MY_Model {
    
    function __construct() {
        parent::__construct();
        $this->tablename = 'series';
        $this->keyfield = 'Series'; 
    }
    
     /**
     * Return the series of bots that are currently known of. 
     */
    
    public function GameSummary(){
        $query = $this->db->query('SELECT Series, Description, '
                . 'Value, Frequency as Pieces_Available From series');
      
        return $query->result();  
    }

}
