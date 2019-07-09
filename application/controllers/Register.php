<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Register extends CI_Controller {

    private $view;

    public function __construct() {

        parent::__construct();
        $this->load->helper(array('form', 'url'));
        if($this->session->userdata('id')) {
            redirect('private_area');
        }

        $this->load->library('form_validation');
        $this->load->model('register_model');
    }

    function index() {

        $this->form_validation->set_rules('first_name', 'First_name', 'required|trim');
		$this->form_validation->set_rules('surname', 'Surname', 'required');
		$this->form_validation->set_rules('emailaddress', 'Email', 'required|trim|valid_email|is_unique[user_info.email]');
        $this->form_validation->set_rules('phone', 'Telephone', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');

        $config['upload_path']          = './uploads/';
        $config['allowed_types']        = 'gif|jpg|png';
        $config['max_size']             = 100;
        $config['max_width']            = 1024;
        $config['max_height']           = 768;

        $this->load->library('upload', $config);
        
        if ($this->form_validation->run()) {
            $error = false;
            $data = array(
                'first_name'        =>  $this->input->post('first_name'),
                'surname'           =>  $this->input->post('surname'),
                'email'             =>  $this->input->post('emailaddress'),
                'password'          =>  sha1($this->input->post('password')),
                'verification_key'  =>  md5(time()),
                'telephone'         =>  $this->input->post('phone'),
            );

            if(!$this->upload->do_upload('profile_picture')) {
                $this->view['message'] = $this->upload->display_errors();
                $error = true;
            } else {
                $success = array('upload_data' => $this->upload->data());
                $data['profile_picture'] = base_url('uploads/'.$success['upload_data']['file_name']);
            }
    
            if(!$error)
                $id = $this->register_model->insert($data);
        }
        
        //$this->view['message'] = "Test message";

        $this->load->view('register', $this->view);
    }

}

?>
