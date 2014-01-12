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
        $this->load->helper('form');
//        $this->load->library('form_validation');
//
//        $this->form_validation->set_rules('email', 'Email', 'required');
//        $this->form_validation->set_rules('password', 'Password', 'required');

//            $email=$this->input->post('email');
        $email = $_GET['email'];

//            $password=hash('sha256', $this->input->post('password') . $this->input->post('email'));
        $password=hash('sha256', $_GET['password'] . $_GET['email']);

            $result=$this->usersession_model->login($email,$password);

            if($result == 1){
                echo '{"login": 1}';
            } else {
                echo '{"login": 0}';
            }
    }


}
