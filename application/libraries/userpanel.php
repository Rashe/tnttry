<?php
class Userpanel {

    private $CI;

    function __construct()
    {
        $this->CI =& get_instance();

        $this->CI->load->helper('form');
        $this->CI->load->model('user_model');
    }

    function getUserpanel()
    {
        $user_name = $this->CI->session->userdata('user_name');
        $data['username'] = $user_name != '' ? $user_name : false;

        return $this->CI->load->view('templates/userpanel', $data, true);
    }
}
