<?php
class User_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }

    function create_account()
    {
        $username = $this->input->post('username', TRUE);
        $email    = $this->input->post('email', TRUE);
        $password = $this->input->post('password', TRUE);

        $this->db->insert('users', array(
            'username' => $username,
            'email'    => $email,
            'password' => hash('sha256', $password . $email)
        ));

        return array(
            'email'    => $email,
            'password' => $password
        );
    }

    function login($email, $password)
    {
        $this->db->where('email', $email);
        $this->db->where('password', hash('sha256', $password . $email));

        $query = $this->db->get('users');
        if ($query->num_rows() > 0) {
            $result = $query->result();

            $this->session->set_userdata(array(
                'user_id'    => $result[0]->id,
                'user_name'  => $result[0]->username,
                'user_email' => $result[0]->email,
                'logged_in'  => TRUE,
            ));

            return TRUE;
        }

        return FALSE;
    }

    function get_userdata($username = null)
    {
        $username = $username ? $username : $this->session->userdata('user_name');
        $u = $this->db->get_where('users', array('username' => $username));
        return $u->result_array();
    }

    function change_userdata()
    {
        $username = $this->session->userdata('user_name');
        $email    = $this->input->post('email', TRUE);
        $password = $this->input->post('password', TRUE);

        $this->update_userdata($username, $email, $password);

        $this->session->set_userdata(array(
            'user_email' => $email
        ));

        return array(
            'email'    => $email,
            'password' => $password
        );
    }

    function new_password(){
        $username = $this->input->post('username', TRUE);
        $email = $this->input->post('email', TRUE);

        $password = $this->generate_password();
        $this->user_model->update_userdata($username, $email, $password);

        return array(
            'username' => $username,
            'email'    => $email,
            'password' => $password
        );
    }

    function username_exists($username)
    {
        if($this->db->get_where('users', array('username' => $username))->num_rows){
            return true;
        }
        return false;
    }

    function email_exists($email)
    {
        if($this->db->get_where('users', array('email' => $email))->num_rows){
            return true;
        }
        return false;
    }

    private function generate_password($length = 8)
    {
        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        $password = substr(str_shuffle($chars), mt_rand(0, strlen($chars) - $length), $length);
        return $password;
    }

    private function update_userdata($username, $email, $password)
    {
        $this->db->update('users', array(
            'email'    => $email,
            'password' => hash('sha256', $password . $email)
        ), array('username' => $username));
    }
}
