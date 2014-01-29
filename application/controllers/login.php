<?php
class Login extends CI_Controller {

    function __construct()
    {
        parent::__construct();
        $this->load->library('login_library');
    }

    function index()
    {
        $email = $this->input->post('email');
        $password = $this->input->post('password');

        $this->login_library->login($email, $password);

        redirect();
    }

    function logout()
    {
        $this->session->unset_userdata(array(
            'user_id'    => '',
            'user_name'  => '',
            'user_email' => '',
            'logged_in'  => false,
        ));
        $this->session->sess_destroy();

        redirect();
    }
}
