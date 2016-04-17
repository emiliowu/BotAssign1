<?php

/**
 * Description of playerRegistration
 *
 * @author Khang
 */
class playerRegistration extends MY_Model {
    
    public function __construct() {
        parent::__construct();
    }
    
    /*public function get($whom){
        $data = $this->db->get_where('players', $whom)->result_array();

        if(empty($data)){return NULL;}

        return $data[0];
    }*/
    
    //this function query's the players in the database
    public function userLoginInfo(){
        $query = $this->db->query('SELECT username FROM playerLogin');
        return $query->result();
    }
    
    //this function injects whatever field they filled out
    public function registerAccount($username,$password){
        //this is basically passing an array to the insert statement based on
        //column name and column value
        $acctData = array(
            'username' => $username,
            'password' => $password
        );
        //this statement generates: 
        //INSERT INTO playerLogin (username, password) VALUES($username, $password)  
        $this->db->insert('playerLogin', $acctData); 
    }
    
    //this function inserts into players table with a default value of 100 peanuts
    public function updatePlayers($username){
        //this is basically passing an array to the insert statement based on
        //column name and column value
        $playerData = array(
            'Player' => $username,
            'Peanuts' => '100'
        );
        //this statement generates: 
        //INSERT INTO players (Player, Peanuts) VALUES($username, '100') 
        $this->db->insert('players', $playerData); 
    }
    
    
}
