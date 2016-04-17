<?php

/**
 * core/MY_Controller.php
 *
 * Default application controller
 *
 * @author		JLP
 * @copyright           2010-2015, James L. Parry
 * ------------------------------------------------------------------------
 */
class Application extends CI_Controller {

    protected $data = array();      // parameters for view components
    protected $id;                  // identifier for our content

    /**
     * Constructor.
     * Establish view parameters & load common helpers
     */

    function __construct() {
        parent::__construct();
        $this->data = array();
        $this->errors = array();
        $this->userLogin();
        $this->getToken();
    }

    //function userLogin is configured in core controller becuase you want it
    //to load everytime the _template.php is loaded for all pages
    function userLogin() {
        //loads the model playerLogin which uses the function to grab the player query
        $this->load->model('playerLogin');

        //try to call the query in the model to initialize it
        $query = $this->playerLogin->userLogin();
        $player = array();

        foreach ($query as $row) {
            $player[] = $row->Player;
        }

        //gets the username and action from the form
        $username = $this->input->get_post('username');
        $whatToDo = $this->input->get_post('do');
        //now it's time to create the session
        //first condition checks if the username input is not empty and that the action is set to logout
        if (!empty($username) && $whatToDo === 'login') {
            if (array_search($username, $player) !== FALSE) {
                // username in table   
                //array('username'=>$username) creates an array in the session
                //with a keyfield of username and it's value is the var $username
                $this->session->set_userdata(array('username' => $username));
            } else {
                // username not in table
                $this->data['welcomeMsg'] = 'Please Enter a Username';
            }
        } else if ($whatToDo === 'logout') {
            //this statement will clear the value given to the key field "username"
            $this->session->unset_userdata('username');
        }

        //this condition checks to see if the user is logged in. 
        if ($this->session->userdata('username')) {
            $this->data['welcomeMsg'] = 'Welcome ' . $this->session->userdata('username');
            $this->data['login'] = 'Logout'; //if logged in, the button value would be changed to logout
            $this->data['loginForm'] = 'none'; //if signed in, the prompt for username is not displayed
            $this->data['loginDo'] = 'logout'; //button value would be the case of logout
        } else {
            $this->data['welcomeMsg'] = 'Please Enter a Username';
            $this->data['login'] = 'Login'; //if not logged in, the button value would be changed to login
            $this->data['loginForm'] = 'inline'; //if not signed in, the prompt for username is displayed
            $this->data['loginDo'] = 'login'; //button value would be the case of logging in
        }
    }

    // get token to communicate with BCC server
    private function getToken() {
        $this->session->unset_userdata('token');
        $postdata = http_build_query(
                array(
                    'team' => 'b01',
                    'name' => 'Skynet',
                    'password' => 'tuesday'
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
        $result = file_get_contents('http://ken-botcards.azurewebsites.net/register', false, $context);
        $xml = simplexml_load_string($result);
        $token = (string) $xml->token;
        $this->data['token'] = $token;
        $this->session->set_userdata(array('token'=>$token));
    }
    
    /**
     * Render this page
     */
    function render() {
        $this->data['content'] = $this->parser->parse($this->data['pageBody'], $this->data, true);

        // finally, build the browser page!
        $this->data['data'] = &$this->data;
        $this->parser->parse('_masterPageHeader', $this->data);
        $this->parser->parse('_masterPageNavbar', $this->data);
        $this->parser->parse('_template', $this->data);
    }
}
