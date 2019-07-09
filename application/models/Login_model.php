<?php

class Login_model extends CI_Model {

    function can_login($email, $password) {

        $this->db->where('email', $email);
        $this->db->select('ID,first_name,surname,email,password');

        $query = $this->db->get('user_info')->result();
        if(count($query)!==1) {
            return 'Wrong mail adress';
        } else {
            $user = $query[0];
            if(sha1($password)!==$user->password)
                return 'Wrong password';

            unset($user->password);
            $this->session->set_userdata('user', $user);
            
            return true;
        }

    }
}
?>