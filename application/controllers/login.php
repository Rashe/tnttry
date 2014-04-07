<?php
class Login extends CI_Controller {

    function __construct()
    {
        parent::__construct();
        $this->load->model('user_model');
    }

    function index()
    {
        $email = $this->input->post('email', TRUE);
        $password = $this->input->post('password', TRUE);

        echo $this->user_model->login($email, $password) ? 'success' : json_encode(false);
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
