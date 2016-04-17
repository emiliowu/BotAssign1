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
            if(empty($playerCards)){
                $this->data['playerCards']='You have no cards at the moment!';
                $this->render(); 
            }else{
                $this->playerCards($player);
                $this->selectHeads($player);
                $this->selectBody($player);
                $this->selectLegs($player);
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

}

/* End of file Assemble_page.php */
/* Location: application/controllers/Assemble_page.php */
