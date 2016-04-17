<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of playerLogin
 *
 * @author Khang
 */
class playerLogin extends MY_Model {
    
    public function __construct() {
        parent::__construct();
    }
    
 
    //this function query's the players in the database
    public function userLogin(){
        $query = $this->db->query('SELECT * FROM playerLogin');
        return $query->result();
    }
    
    public function avatarGet($player){
        $query = $this->db->query('SELECT avatar FROM playerLogin WHERE username ="'.$player.'"');
        $ret = $query->row();
        return $ret->avatar;
    }
}
