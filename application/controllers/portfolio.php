<?php

/*
 * application/controllers/Portfolio.php
 */

class portfolio extends Application {

    function __construct() {
        parent::__construct();
    }

    public function index($players = "user") {
        $this->data['pageBody'] = 'portfolio';

        //have to make condition that states if a user sesison is logged in
        //in or not 
        if ($this->session->userdata('username')) {
            $sessionPlayers = $this->session->userdata('username');
            $this->getActivities($sessionPlayers);
            $this->getCards($sessionPlayers);
        } else {
            //display default player which is Donald
            $sessionPlayers = "unknown";
            $this->getActivities($players);
            $this->getCards($players);
        }

        $this->data['playerDropdown'] = $this->parser->parse('_portfolioPlayerDropdown', $this->getPlayers(), true);
        $this->getActivities($players);
        $this->getCards($players);
        if ($players) {
            $this->data['username'] = $players;
        } else {
            $this->data['username'] = $sessionPlayers;
        }
        
        $this->render();
    }

    //This function gets the players in the db and displays it into a dropdown list
    function getPlayers() {
        $this->load->model('players');
        //calls on the players model and refers to the all function
        //all is assigned to players
        $allPlayers = $this->players->all();
        $list = array();

        foreach ($allPlayers as $player) {
            $selection['player'] = $player->Player;
            $selection['link'] = "/portfolio/" . $player->Player;
            $list[] = $selection;
        }

        $players['selections'] = $list;
        return $players;
    }

    //This function gets the activities or transactions made by that player
    private function getActivities($players) {
        $this->load->model('portfolioTransactions');

        if ($players != 'user') {
            $result = $this->portfolioTransactions->get_transactions($players);
        } else {
            $players = $this->session->userdata('username');
            $result = $this->portfolioTransactions->get_transactions($players);
        }

        $list = array();
        foreach ($result as $row) {
            $list[] = (array) $row;
        }
        $data['transactions'] = $list;
        $this->data['transactions'] = $this->parser->parse('_portfolioActivities', $data, true);
    }

    //this function gets the cards that player has
    private function getCards($players) {
        $this->load->model('portfolioCollections');

        if ($players != 'user') {
            $this->collectionsHelper($players);
        } else {
            $players = $this->session->userdata('username');
            $this->collectionsHelper($players);
        }
    }

    private function collectionsHelper($players) {
        $this->data['11ah'] = $this->portfolioCollections->getCollections($players, "11a-0");
        $this->data['11ab'] = $this->portfolioCollections->getCollections($players, "11a-1");
        $this->data['11al'] = $this->portfolioCollections->getCollections($players, "11a-2");

        $this->data['11bh'] = $this->portfolioCollections->getCollections($players, "11b-0");
        $this->data['11bb'] = $this->portfolioCollections->getCollections($players, "11b-1");
        $this->data['11bl'] = $this->portfolioCollections->getCollections($players, "11b-2");

        $this->data['11ch'] = $this->portfolioCollections->getCollections($players, "11c-0");
        $this->data['11cb'] = $this->portfolioCollections->getCollections($players, "11c-1");
        $this->data['11cl'] = $this->portfolioCollections->getCollections($players, "11c-2");

        $this->data['13ch'] = $this->portfolioCollections->getCollections($players, "11b-0");
        $this->data['13cb'] = $this->portfolioCollections->getCollections($players, "11b-1");
        $this->data['13cl'] = $this->portfolioCollections->getCollections($players, "11b-2");

        $this->data['13dh'] = $this->portfolioCollections->getCollections($players, "13c-0");
        $this->data['13db'] = $this->portfolioCollections->getCollections($players, "13c-1");
        $this->data['13dl'] = $this->portfolioCollections->getCollections($players, "13c-2");

        $this->data['26hh'] = $this->portfolioCollections->getCollections($players, "26h-0");
        $this->data['26hb'] = $this->portfolioCollections->getCollections($players, "26h-1");
        $this->data['26hl'] = $this->portfolioCollections->getCollections($players, "26h-2");
    }
}

/* End of file Portfolio.php */
/* Location: application/controllers/Portfolio.php */
