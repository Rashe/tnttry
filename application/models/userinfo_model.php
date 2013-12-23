<?php

class Userinfo_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
    }

    public function get_username()
    {
       return $this->session->userdata('user_name');
    }


    public function get_email()
    {
        $username = $this->session->userdata('name');
        $this->db->where("username", $username);
        $q = $this->db->get('users');
        $data = $q->result_array();
        return ($data[0]['email']);
    }


    function get_password()
    {
        $username = $this->session->userdata('name');
        $this->db->where("username", $username);
        $q = $this->db->get('users');
        $data = $q->result_array();
        return ($data[0]['password']);
    }

}