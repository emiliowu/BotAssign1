<?php

class administration extends Application
{

    function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
    }

    public function index()
    {
        if ($this->session->userdata('username') == "admin") {
        $this->data['pageBody'] = 'adminPage';
         //have to make condition that states if a user sesison is logged in
        //in or not 
        $this->admin(); 
        } else{
            echo "<script>alert('You do not have permission to access the admin page!')</script>";
            redirect('home', 'refresh');
        }
    }
    
    private function admin(){

        
        $this->data['resultMsg'] = '';
        $this->load->model('adminPlayers');

        //try to call the query in the model to initialize it
        $query = $this->adminPlayers->getPlayer();
        $playerStatus = array();

        foreach ($query as $row)
        {
            $playerStatus[] = (array) $row;
        }
     
        $players['playerTable'] = $playerStatus;
        $this->data['playerAdmin'] = $this->parser->parse('_adminTable', $players, true);        
        $this->render();
    }
    
    //consider this a onclick event that belongs to the delete button
    function delete(){
        $player = $this->input->post('whichPlayer');
        $this->load->model('adminPlayers');
        $this->adminPlayers->updatePlayers($player);
        $this->adminPlayers->updatePlayerLogin($player); 
        //$this->data['resultMsg'] = 'You have removed ' . $player . '!'; 
        redirect('administration', 'refresh');
    }
    
}

