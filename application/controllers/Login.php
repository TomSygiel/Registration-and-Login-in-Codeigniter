<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

    public function __construct() {

        parent::__construct();
        $this->load->library('form_validation');
        $this->load->library('session');
        $this->load->model('login_model');
        $this->load->model('admin_model');
    }

    function index() {
 
		$this->form_validation->set_rules('emailaddress', 'Email', 'required|valid_email');
		$this->form_validation->set_rules('password', 'Password', 'required');
        
        if ($this->form_validation->run()) {
            
            $username = $this->input->post('emailaddress');
            $password = $this->input->post('password');
            
            if($this->login_model->can_login($username, $password)) {  
                 $session_data = array(  
                    'user'     => $this->admin_model->fetch_single_data_by_email($username)
                );  
                $this->session->set_userdata($session_data);  
                redirect('private_area');  
            
            } else {
                $this->session->set_flashdata('message', $session_data);
                redirect('login');
            }
		}
        
        $this->load->view('login');
    }

}

?>