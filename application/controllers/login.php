<?php
class Login extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->model('login_model');


    }

    public function index()
    {
        if(($this->session->userdata('user_name')!=""))
        {
            $this->load->view('pages/home');
            return;
        }
        $this->load->view('templates/login', $data);

    }

    public function login()
    {
        $email=$this->input->post('email');

        $password=hash('sha256', $this->input->post('password') . $this->input->post('email'));

        $result=$this->user_model->login($email,$password);
        if($result) $this->load->view('pages/home');
        else        $this->load->view('pages/home');
    }

    public function logout()
    {
        $newdata = array(
            'user_id'   =>'',
            'user_name'  =>'',
            'user_email'     => '',
            'logged_in' => FALSE,
        );
        $this->session->unset_userdata($newdata );
        $this->session->sess_destroy();
        $this->index();
    }


}
