<?php
class Userstats_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }

    function add_user()
    {
        $this->db->insert('user_stats', array(
            'username' => $this->input->post('username', TRUE)
        ));
    }

    function get_userstatsdata()
    {
        $username = $this->session->userdata('user_name');
        $u = $this->db->get_where('user_stats', array('username' => $username));
        return $u->result_array();
    }
} 