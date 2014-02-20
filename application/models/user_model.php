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

    function get_userdata()
    {
        $username = $this->session->userdata('user_name');
        $u = $this->db->get_where('users', array('username' => $username));
        return $u->result_array();
    }
}
