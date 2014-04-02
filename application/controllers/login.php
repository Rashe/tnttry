<?php
class Login extends CI_Controller {

    function __construct()
    {
        parent::__construct();
        $this->load->library('login_library');
        $this->load->model('user_model');
    }

    function index()
    {
        $email = $this->input->post('email', TRUE);
        $password = $this->input->post('password', TRUE);

        echo $this->login_library->login($email, $password) ? 'success' : 'fail';
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
