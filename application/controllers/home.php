<?php

/*
 * application/controllers/Home.php
 */

class home extends Application
{

    function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $this->data['pageBody'] = 'homepage';
        $this->gameStatus();
        $this->playerInfo();
    }
	
    private function gameStatus()
    {
        $this->load->model('gameStatus');
        $query = $this->gameStatus->gameSummary();

        $gameStatus = array();

        foreach ($query as $stat)
        {
            $gameSummary[] = (array) $stat;	
        }

        $Status['seriesInfo'] = $gameSummary;

        $this->data['gameStatus'] = $this->parser->parse('_seriesInfo', $Status, true);
    }

     private function playerInfo() 
    {
        $this->load->model('playerInfo');

        //try to call the query in the model to initialize it
        $query = $this->playerInfo->playerEC();
        $playerInfo = array();

        foreach ($query as $row)
        {
            $playerInfo[] = (array) $row;
        }
        
        $players['playerTable'] = $playerInfo; 
        $this->data['playerInfo'] = $this->parser->parse('_playerTable', $players, true);        
        $this->render();
    }

}

/* End of file Home.php */
/* Location: application/controllers/Home.php */

