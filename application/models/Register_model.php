<?php

class Register_model extends CI_Model {

    private $table;

    public function __construct(){
        parent::__construct();

        $this->table = "user_info";
    }

    function insert($data) {
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }

    function verify_email($key) {

        $this->db->where('verification_key', $key);
        $this->db->where('is_email_verified', 'no');
        $query = $this->db->get($this->table);

        if($query->num_rows() > 0) {
            $data = array(
                'is_email_verified'  => 'yes'
            );
            $this->db->where('verification_key', $key);
            $this->db->update($this->table, $data);
            return true;
        } else {
            return false;
        }
    }
}
?>