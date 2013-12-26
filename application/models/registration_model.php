<?php

class Registration_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
    }

    public function create_account()
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

        if($this->db->get_where('users', array('username' => $users['username']))->num_rows){
            return array('error' => true, 'msg' => 'Username "' . $users['username'] . '" already exists!');
        }
        if($this->db->get_where('users', array('email' => $users['email']))->num_rows){
            return array('error' => true, 'msg' => 'Email "' . $users['email'] . '" already exists!');
        }

        $users_a = $this->db->insert('users', $users);
        $users_stats_a =$this->db->insert('user_stats', $users_stats);

       return $users_a + $users_stats_a;
    }

}
