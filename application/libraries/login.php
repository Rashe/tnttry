<?php
class Login {

    public function __construct()
    {
        $CI =& get_instance();

        $CI->load->helper('url');
        $CI->load->helper('form');
        $CI->load->model('usersession_model');
    }

    public function index()
    {
        $CI =& get_instance();

        if(($CI->session->userdata('user_name') != ''))
        {
            $data['username'] = $CI->session->userdata('user_name');
            return $this->getUserpanel($data, true);
        }

        $CI->load->helper('form');
        $CI->load->library('form_validation');

        $CI->form_validation->set_rules('email', 'Email', 'required');
        $CI->form_validation->set_rules('password', 'Password', 'required');

        $email = $CI->input->post('email');
        $password = $CI->input->post('password');

        return $this->login($email, $password);
    }

    public function login($email, $password)
    {
        $CI =& get_instance();

        if(!$CI->usersession_model->login($email, $password)) {
            return $this->getUserpanel(null, false);
        }

        $data['username'] = $CI->session->userdata('user_name');
        return $this->getUserpanel($data, true);
    }

    private function getUserpanel($data = array(), $loggedIn)
    {
        $CI =& get_instance();

        $data['loggedIn'] = $loggedIn;
        return $CI->load->view('templates/userpanel', $data, true);
    }
}
