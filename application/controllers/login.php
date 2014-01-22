<?php
class Login extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->library('login');
    }

    public function index()
    {
        if(isset($_GET['logout'])){
            $this->session->sess_destroy();
        }

        $this->login->index();
    }
}
