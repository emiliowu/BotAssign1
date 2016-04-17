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

        if ($this->session->userdata('username')) {
            if ($sessionPlayers === $players || $this->data['username'] === 'user') {
                $this->transactionsAction($sessionPlayers);
            } else {
                echo "<script>alert('You do not have permissions to buy/sell for this player!')</script>";
            }
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

    // helper function for transaction buttons
    private function transactionsAction($playerName) {
        if (!is_null($this->input->post('buy'))) {
            $this->buyPieces($playerName);
        }
        if (!is_null($this->input->post('sell'))) {
            $this->sellPieces($playerName);
        }
    }

    // function to buy pieces from the BCC server
    private function buyPieces($playerName) {
        $this->load->model('portfolioBuy');
        $token = $this->session->userdata['token'];
        $postdata = http_build_query(
                array(
                    'team' => 'b01',
                    'token' => $token,
                    'player' => $playerName
                )
        );

        $post = array('http' =>
            array(
                'method' => 'POST',
                'header' => 'Content-type: application/x-www-form-urlencoded',
                'content' => $postdata
            )
        );

        //$context = stream_context_create($post);
        //$result = file_get_contents('http://botcards.jlparry.com/register', false, $context);
        //$xml = simplexml_load_string($result);
        //$token = (string) $xml->token;

        $context = stream_context_create($post);
        $result = file_get_contents('http://botcards.jlparry.com/buy', false, $context);
        $xml = simplexml_load_string($result);
        //print_r($xml);
        //die();
        foreach ($xml->certificate as $certificate) {   //$xml->xpath('//certificate') as $certificate) {
            $pName = $certificate->player;
            $piece = $certificate->piece;
            $cToken = $certificate->token;
            //$datetime = $certificate->datetime;

            $this->portfolioBuy->updateCollections($pName, $piece, $cToken);
            //$this->portfolioBuy->updateTransactions($playerName);
        }
    }

    // function to sell pieces from the BCC server
    private function sellPieces() {
        
    }

}

/* End of file Portfolio.php */
/* Location: application/controllers/Portfolio.php */
