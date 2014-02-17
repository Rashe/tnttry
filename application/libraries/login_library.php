<?php
class Login_library {

    private $CI;

    public function __construct()
    {
        $this->CI =& get_instance();

        $this->CI->load->helper('form');
        $this->CI->load->model('user_model');
    }

    public function userpanel()
    {
        if(($this->CI->session->userdata('user_name') != '')) {
            $data['username'] = $this->CI->session->userdata('user_name');
            return $this->getUserpanel($data, TRUE);
        }

        return $this->getUserpanel(null, FALSE);
    }

    public function login($email, $password)
    {
        if(!$this->CI->user_model->login($email, $password)) {
            return FALSE;
        }
        $data['username'] = $this->CI->session->userdata('user_name');
        return $this->getUserpanel($data, TRUE);
    }

    private function getUserpanel($data = array(), $loggedIn)
    {
        $data['loggedIn'] = $loggedIn;
        return $this->CI->load->view('templates/userpanel', $data, TRUE);
    }
}
