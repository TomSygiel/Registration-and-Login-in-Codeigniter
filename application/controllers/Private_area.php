<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Private_area extends CI_Controller {

    public function __construct() {

        parent::__construct();
        if (!$this->session->userdata('user')) {
            redirect('login');
        }

        // print_r($this->session->userdata('user'));
    }

    function index() {
        
        echo 'Welcome user';
    
        echo '
        <p><a href="'.base_url().'private_area/logout">Log out</a></p>
        ';
    }

    function logout() {
        $this->session->unset_userdata('user');
        $this->session->unset_userdata('username');
        redirect('login');
    }

}

?>