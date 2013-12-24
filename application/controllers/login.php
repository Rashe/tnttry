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
        if(($this->session->userdata('user_name')!=""))
        {
            $this->load->view('templates/header');
            $this->load->view('pages/home');
            $this->load->view('templates/footer');
            return;
        }

        $this->load->helper('form');
        $this->load->library('form_validation');

        $this->form_validation->set_rules('email', 'Email', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');

            $email=$this->input->post('email');

            $password=hash('sha256', $this->input->post('password') . $this->input->post('email'));

            $result=$this->usersession_model->login($email,$password);
            if($result) $this->load->view('pages/home');
            else        $this->load->view('templates/login');
    }


}
