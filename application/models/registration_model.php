<?php

class Registration_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
    }

    public function create_account()
    {
        $ok = true;
        $errors = array();

        $users = array(
            'username' => $this->input->post('username'),
            'email' => $this->input->post('email'),
            'password' =>
                hash('sha256', $this->input->post('password') . $this->input->post('email'))
        );
        $users_stats =array(
            'username' => $this->input->post('username')
        );

        if($this->db->get_where('users', array('username' => $users['username']))->num_rows){
            $errors[] = array('error' => true, 'msg' => 'Username "' . $users['username'] . '" already exists!');
            $ok = false;
        }
        if($this->db->get_where('users', array('email' => $users['email']))->num_rows){
            $errors[] = array('error' => true, 'msg' => 'Email "' . $users['email'] . '" already exists!');
            $ok = false;
        }

        if(!$ok) return $errors;

        $this->db->insert('users', $users);
        $this->db->insert('user_stats', $users_stats);

       return array(
           'email' => $users['email'],
           'password' => $this->input->post('password')
       );
    }

}
