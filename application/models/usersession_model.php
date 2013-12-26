<?php

class Usersession_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
    }

    public function update_settings()
    {
        $users = array(
            'email' => $this->input->post('email'),
            'password' =>
                hash('sha256', $this->input->post('password') . $this->input->post('email'))
        );
        $users_stats =array(
            'username' => $this->input->post('username')
        );
        $users_a = $this->db->insert('users', $users);
        $users_stats_a =$this->db->insert('user_stats', $users_stats);

        return $users_a + $users_stats_a;
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
        $users_a = $this->db->insert('users', $users);
        $users_stats_a =$this->db->insert('user_stats', $users_stats);

        return $users_a + $users_stats_a;
    }

    function login($email,$password)
    {
        $this->db->where("email",$email);
        $this->db->where("password",$password);

        $query=$this->db->get("users");
        if($query->num_rows()>0)
        {
            foreach($query->result() as $rows)
            {
                //add all data to session
                $newdata = array(
                    'user_id'  => $rows->id,
                    'user_name'  => $rows->username,
                    'user_email'    => $rows->email,
                    'logged_in'  => TRUE,
                );
            }
            $this->session->set_userdata($newdata);
            return true;
        }

        return false;
    }

}