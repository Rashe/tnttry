<?php
class Login extends CI_Controller {

    function __construct()
    {
        parent::__construct();
        $this->load->library(array('login_library', 'user_agent'));
    }

    function index()
    {
        $email = $this->input->post('email');
        $password = $this->input->post('password');

        $login = $this->login_library->login($email, $password);
        $this->session->set_flashdata('login_fail', TRUE);
        redirect($login ? '' : $this->agent->referrer());
    }

    function logout()
    {
        $this->session->unset_userdata(array(
            'user_id'    => '',
            'user_name'  => '',
            'user_email' => '',
            'logged_in'  => FALSE,
        ));
        $this->session->sess_destroy();

        redirect();
    }
}
