<?php

class registration extends Application
{

    function __construct()
    {
        parent::__construct();
        $this->load->helper(array('form', 'url'));
    }

    public function index()
    {
        if ($this->session->userdata('username')) {
            echo "<script>alert('You're already signed in. No need to create an account)</script>";
            redirect('home', 'refresh');
        } else{
             $this->data['pageBody'] = 'registrationPage';
             //have to make condition that states if a user sesison is logged in
            //in or not 
            $this->createAccount(); 
            $this->render();
        }
    }
    
    private function stillLoggedIn(){
        $this->data['pleaseLogout'] = "You must logout first before registering an account"; 
    }
    //this function should get the username and password field given by the user
    //and injects it into the database
    
    private function createAccount(){
        
        //loads the model playerRegistration which uses the function to add to the player query
         $this->load->model('playerRegistration');
         $this->load->model('avatarSet');
        
        $query = $this->playerRegistration->userLoginInfo(); 
        $acctList = array();

        foreach ($query as $row) {
            $acctList[] = $row->username;
        }
        $this->data['regDo'] = 'register'; //button value would be the case of logging in
        $username = $this->input->get_post('newUsername');
        $password = $this->input->get_post('newPassword'); 
        $whatToDo = $this->input->get_post('regDo');
        
        $this->data['registerMsg'] = 'Please Enter a Username and Password';
        $this->data['register'] = 'Register Account'; //if not logged in, the button value would be changed to login
        $this->data['registerForm'] = 'inline'; //if not signed in, the prompt for username is displayed
        
        $this->data['resultMsg'] = '';
       
        
        //now it's time to create the session
        //first condition checks if the username input is not empty and that the action is set to logout
        if ($whatToDo === 'register') {
            if (array_search($username, $acctList) !== FALSE) {
                // if username does match any existing accts, not eligible to create an acct   
                //array('username'=>$username) creates an array in the session
                //with a keyfield of username and it's value is the var $username
                //$this->session->set_userdata(array('username' => $username));
                $this->data['resultMsg'] = "The account you wish to create already exists. Please choose a different username!"; 
            } else {
                //if a username does not match any existing accts, eligible to create an acct 
                //loads function in loaded model 
                $this->playerRegistration->registerAccount($username,$password);
                $this->playerRegistration->updatePlayers($username); 
                $this->session->set_userdata(array('username' => $username));
              
                $config['upload_path'] = './assets/avatars/';
                $config['allowed_types'] = 'png';
                $config['max_size']	= '1200';
                $config['max_width']  = '100';
                $config['max_height']  = '100';

                $this->load->library('upload', $config);
                $avatarFileName = $_FILES['userfile']['name'];
                $pathInfo = pathinfo($avatarFileName);
                $this->avatarSet->avatarUpdate($this->session->userdata('username'), $pathInfo['filename']);
                $this->data['resultMsg'] = "Your account has been created".print_r($this->upload->data(),TRUE);
    
            }
        } else {
           $this->data['resultMsg'] = "You cannot leave any fields empty"; 
        }
        
        /*
         //this condition checks to see if the user is logged in. 
        if ($this->session->userdata('username')) {
            //display a header saying you must be logged out to register 
        } else {
            $this->data['registerMsg'] = 'Please Enter a Username and Password';
            $this->data['register'] = 'Register Account'; //if not logged in, the button value would be changed to login
            $this->data['registerForm'] = 'inline'; //if not signed in, the prompt for username is displayed
            $this->data['regDo'] = 'register'; //button value would be the case of logging in
        }
         */
    }
    //this is the function to upload a picture for your avatar
    function do_upload()
	{
            $this->load->model('avatarSet');
            $config['upload_path'] = '../../assets/avatars/';
            $config['allowed_types'] = 'png';
            $config['max_size']	= '1200';
            $config['max_width']  = '100';
            $config['max_height']  = '100';

            $this->load->library('upload', $config);

            if ( ! $this->upload->do_upload())
            {
                    echo "there was a problem uploading the image, try another one.";
                    header('Refresh: 3;url=../home.php');
            }
            else
            {
                    $avatarFileName = $_FILES['userfile']['name'];
                    $pathInfo = pathinfo($avatarFileName);
                    $this->avatarSet->avatarUpdate($this->session->userdata('username'), $pathInfo['filename']);
                    header('Refresh: 2;url=../home.php');
            }
	}
    
}
