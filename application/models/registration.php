<?php

class Registration extends CI_Model {

    public function __construct()
    {
        $this->load->database();
    }

    public function create_account()
    {

        $data = array(
            'username' => $this->input->post('username'),
            'email' => $this->input->post('email'),
            'password' =>
                hash('sha256', $this->input->post('password') . $this->input->post('email'))
        );

        return $this->db->insert('users', $data);
    }

}
