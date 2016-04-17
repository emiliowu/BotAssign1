<?php

class players extends MY_Model {

    // constructor
    function __construct() {
        //players is the table id
        //Player is the keyField 
        parent::__construct('players', 'Player');
    }

}
