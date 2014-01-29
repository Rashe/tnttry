<?php

class Registration_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }

    function create_account()
    {
        $users = array(
            'username' => $this->input->post('username'),
            'email' => $this->input->post('email'),
            'password' =>
                hash('sha256', $this->input->post('password') . $this->input->post('email'))
        );
        $users_stats =array(
            'username' => $this->input->post('username')
        );

        $this->db->insert('users', $users);
        $this->db->insert('user_stats', $users_stats);

       return array(
           'email' => $users['email'],
           'password' => $this->input->post('password')
       );
    }

    function username_exists($username){
        if($this->db->get_where('users', array('username' => $username))->num_rows){
            return true;
        }
        return false;
    }

    function email_exists($email){
        if($this->db->get_where('users', array('email' => $email))->num_rows){
            return true;
        }
        return false;
    }
}
