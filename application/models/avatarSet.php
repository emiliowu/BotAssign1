<?php

/**
 * Description of avatarSet
 *
 * @author Anderson
 */
class avatarSet extends MY_Model {
    
    public function __construct() {
        parent::__construct();
    }
		public function avatarUpdate($player, $image){
		$query = $this->db->query('UPDATE playerLogin SET avatar = "'.$image.'"WHERE username ="'.$player.'"');
		echo 'Successful upload!';
		}
	}