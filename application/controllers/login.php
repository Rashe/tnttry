<?php
class Login extends CI_Controller {

    public function __construct()
    {

        parent::__construct();
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->model('usersession_model');
    }

    public function index()
    {
        if(isset($_GET['logout'])){
            $this->session->sess_destroy();
        }

        $this->load->helper('form');

        $email = $_GET['email'];
        $password=hash('sha256', $_GET['password'] . $_GET['email']);

        $result=$this->usersession_model->login($email,$password);

        if($result == 1){
            echo '{"login": 1}';
        } else {
            echo '{"login": 0}';
        }
    }
}
