<?php

class adminPlayers extends MY_Model {
    
    public function __construct() {
        parent::__construct();
    }
    
    //this function query's the players in the database
    public function getPlayer(){
        $query = $this->db->query('select L.username, P.Peanuts from playerLogin '
                . 'L INNER JOIN players P ON L.username = P.Player');
        return $query->result();
    }
    
    //this function basically deletes a player from the db
    public function updatePlayers($player){
        $this->db->where('Player',$player);
        $this->db->delete('players');
    }
    
    public function updatePlayerLogin($player){
        $this->db->where('username',$player);
        $this->db->delete('playerLogin');
    }
}

