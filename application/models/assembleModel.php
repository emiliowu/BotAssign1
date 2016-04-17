<?php

class assembleModel extends MY_Model {

    function __construct() {
        parent::__construct();
        $this->tablename = 'collections';
        $this->keyfield = 'piece';
    }

    public function playerCollections($player) {
        $query = $this->db->query('SELECT * FROM Collections WHERE player = "' . $player . '"');
        return $query->result();
    }

    function allHeads($player) {
        $query = $this->db->query('SELECT Piece FROM Collections'
                . ' WHERE Player = "' . $player . '" AND'
                . ' Piece LIKE "%0"');
        //$query = $this->db->query("SELECT `Piece` FROM `collections` WHERE `Piece` LIKE '%0', `Player`=" . $player . "");
        return $query->result();
    }

    function allBody($player) {
        $query = $this->db->query('SELECT Piece FROM Collections'
                . ' WHERE Player = "' . $player . '" AND'
                . ' Piece LIKE "%0"');
        //$query = $this->db->query("SELECT `Piece` FROM `collections` WHERE `Piece` LIKE '%1'");
        return $query->result();
    }

    function allLegs($player) {
        $query = $this->db->query('SELECT Piece FROM Collections'
                . ' WHERE Player = "' . $player . '" AND'
                . ' Piece LIKE "%0"');
        //$query = $this->db->query("SELECT `Piece` FROM `collections` WHERE `Piece` LIKE '%2'");
        return $query->result();
    }

}
