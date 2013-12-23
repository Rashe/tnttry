<?php

class Userinfo_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
    }
    //Gets info from USERS_STATS table

    public  function  get_alluserstatsdata()
    {
        $username = $this->session->userdata('user_name');
        $this->db->where("username", $username);
        $q = $this->db->get('user_stats');
        return $q->result_array();
    }


    //Gets info from USERS table
    public  function  get_alluserdata()
    {
        $username = $this->session->userdata('user_name');
        $this->db->where("username", $username);
        $q = $this->db->get('users');
        return $q->result_array();
    }

    public function get_username()
    {
       return $this->session->userdata('user_name');
    }

    public function get_email()
    {
        $username = $this->session->userdata('user_name');
        $this->db->where("username", $username);
        $q = $this->db->get('users');
        $data = $q->result_array();
        return ($data[0]['email']);
    }

    function get_password()
    {
        $username = $this->session->userdata('user_name');
        $this->db->where("username", $username);
        $q = $this->db->get('users');
        $data = $q->result_array();
        return ($data[0]['password']);
    }

}