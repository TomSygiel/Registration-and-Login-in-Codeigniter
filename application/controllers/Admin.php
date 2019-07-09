<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

    public function index() {
        $this->load->model('admin_model');
        $data['fetch_data'] = $this->admin_model->fetch_data()->result();
        $this->load->view('admin', $data);
    }

    public function delete_data() {
        $this->load->model('admin_model');

        $id = $this->uri->segment(3);

        $user = $this->admin_model->fetch_single_data($id, 'profile_picture');
        if(!$user) return false;

        $delete = $this->admin_model->delete_data($id);

        if($delete){
            $pic = str_replace( base_url('uploads/'), './uploads/', $user->profile_picture );
            unlink($pic);
        }
        redirect(base_url() . 'admin/deleted');
    } 

    public function deleted() {
        $this->index();
    }

    public function update_data() {
        $user_id = $this->uri->segment(3);
        $this->load->model('admin_model');

        
        //Loading the single selected data, but also the array of all records
        $this->view["user_data"] = $this->admin_model->fetch_single_data($user_id);
        $this->view['fetch_data'] = $this->admin_model->fetch_data()->result();

        $this->form_validation->set_rules('first_name', 'First_name', 'required|trim');
		$this->form_validation->set_rules('surname', 'Surname', 'required');
		$this->form_validation->set_rules('emailaddress', 'Email', 'required|trim|valid_email');
        $this->form_validation->set_rules('phone', 'Telephone', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if ($this->form_validation->run()) {

            $data = array(
                'first_name'        =>  $this->input->post('first_name'),
                'surname'           =>  $this->input->post('surname'),
                'email'             =>  $this->input->post('emailaddress'),
                'password'          =>  sha1($this->input->post('password')),
                'verification_key'  =>  md5(time()),
                'telephone'         =>  $this->input->post('phone'),
            );

            if( $this->admin_model->update_data($data, $this->input->post('hidden_ID')) )
                redirect('admin');
        }
    

        $this->load->view('admin', $this->view);
    }

    public function updated() {  
        $this->index();  
    }  

}