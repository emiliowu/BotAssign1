<?php

/*
 * application/controllers/Assemblepage.php
 */

class assemble extends Application {

    function __construct() {
        parent::__construct();
    }

    public function index() {
        $this->data['pageBody'] = 'assemblePage';
        if ($this->session->userdata('username')) {
            $player = $this->session->userdata('username');

            $this->load->model('assembleModel');
            //try to call the query in the model to initialize it
            $query = $this->assembleModel->playerCollections($player);
            $playerCards = array();

            foreach ($query as $row) {
                $playerCards[] = (array) $row;
            }

            //this checks to see if the player has any cards
            if (empty($playerCards)) {
                $this->data['playerCards'] = 'You have no cards at the moment!';
                $this->render();
            } else {
                $this->playerCards($player);
                $this->selectHeads($player);
                $this->selectBody($player);
                $this->selectLegs($player);

                // Check if the game state allows to buy/see
                if ($this->session->userdata('token')) {
                    $this->transactionsAction($player);
                } else {
                    echo "<script>alert('Game state is not open')</script>";
                }

                $this->render();
            }
        } else {
            echo "<script>alert('You must be signed in to access this page!')</script>";
            redirect('home', 'refresh');
        }
    }

    private function playerCards($player) {
        $this->load->model('assembleModel');
        //try to call the query in the model to initialize it
        $query = $this->assembleModel->playerCollections($player);
        $playerCards = array();

        foreach ($query as $row) {
            $playerCards[] = (array) $row;
        }

        $table = array();

        foreach ($playerCards as $index => $row) {
            $new = $row;
            switch ($index % 2 == 0) {
                case TRUE:
                    $new['tableClass'] = "collection1";
                    break;
                case FALSE:
                    $new['tableClass'] = "collection2";
                    break;
            }
            $table[] = $new;
        }

        $players['collectionTable'] = $table;

        $this->data['playerCards'] = $this->parser->parse('_collectionTable', $players, true);
    }

    private function selectHeads($player) {
        $this->load->model('assembleModel');
        $query = $this->assembleModel->allHeads($player);

        $selectHeads = array();

        foreach ($query as $row) {
            $allHeads[] = (array) $row;
        }

        $cards['allPieces'] = $allHeads;

        $this->data['selectHeads'] = $this->parser->parse('_allPieces', $cards, true);
    }

    private function selectBody($player) {
        $this->load->model('assembleModel');
        $query = $this->assembleModel->allBody($player);

        $selectBody = array();

        foreach ($query as $row) {
            $allBody[] = (array) $row;
        }

        $cards['allPieces'] = $allBody;

        $this->data['selectBody'] = $this->parser->parse('_allPieces', $cards, true);
    }

    private function selectLegs($player) {
        $this->load->model('assembleModel');
        $query = $this->assembleModel->allLegs($player);

        $selectLegs = array();

        foreach ($query as $row) {
            $allLegs[] = (array) $row;
        }

        $cards['allPieces'] = $allLegs;

        $this->data['selectLegs'] = $this->parser->parse('_allPieces', $cards, true);
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
        $this->load->model('assembleBuy');
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

        $context = stream_context_create($post);
        $result = file_get_contents('http://ken-botcards.azurewebsites.net/buy', false, $context);
        $xml = simplexml_load_string($result);
        $balance = $xml['balance'];
        foreach ($xml->certificate as $certificate) {
            $pName = $certificate->player;
            $piece = $certificate->piece;
            $cToken = $certificate->token;

            $this->assembleBuy->updateCollections($pName, $piece, $cToken, $balance);
        }
    }

    // function to sell pieces from the BCC server
    private function sellPieces($playerName) {
        $this->load->model('assembleSell');
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

        $context = stream_context_create($post);
        $result = file_get_contents('http://ken-botcards.azurewebsites.net/sell', false, $context);
        $xml = simplexml_load_string($result);
        foreach ($xml->certificate as $certificate) {
            $pName = $certificate->player;
            $topToken = $certificate->piece;
            $midToken = $certificate->token;
            $botToken = $certificate['balance'];

            $this->assembleSell->updateCollections($pName, $topToken, $midToken, $botToken);
        }
    }

}

/* End of file Assemble_page.php */
/* Location: application/controllers/Assemble_page.php */
