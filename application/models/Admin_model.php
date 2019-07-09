<?php

class Admin_model extends CI_Model {

    function insert_data($data) {
       
        $this->db->insert('user_info', $data);
    }

    function fetch_data() {

        $query = $this->db->get('user_info');
        return $query;
    }

    function delete_data($id) {
        $this->db->where('ID', $id);
        return $this->db->delete('user_info');
        //deleting user from user_info table where ID is $id
    }

    public function fetch_single_data_by_email($email, $select = '*'){
        $this->db->where('email', $email);
        $this->db->select($select);
        $query = $this->db->get('user_info')->result();
        if(count($query)===0) return false;
        return $query[0];
    }

    function fetch_single_data($id, $select = '*') {
        $this->db->where('ID', $id);
        $this->db->select($select);
        $query = $this->db->get('user_info')->result();
        if(count($query)===0) return false;
        return $query[0];
    }

    function update_data($data, $id) {  
        $this->db->where('ID', (int) $id);  
        return $this->db->update('user_info', $data); 
    } 

}

?>