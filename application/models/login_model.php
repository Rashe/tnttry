<?php

class Login_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
    }

    function login($email,$password)
    {
        $this->db->where("email",$email);
        $this->db->where("password",$password);

        $query=$this->db->get("user");
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
        echo 'HUJ';
        return false;
    }

}
