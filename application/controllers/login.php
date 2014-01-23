<?php
class Login extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->library('login_library');
    }

    public function index()
    {
        $email = $this->input->post('email');
        $password = $this->input->post('password');

        $this->login_library->login($email, $password);

        redirect();
    }
}
