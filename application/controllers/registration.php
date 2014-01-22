<?php
class Registration extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('registration_model');
    }

    public function index()
    {
        if(($this->session->userdata('user_name') != ""))
        {
            $this->load->view('templates/header');
            $this->load->view('pages/home');
            $this->load->view('templates/footer');
            return;
        }

        $this->load->helper('form');
        $this->load->library('form_validation');

        $data['title'] = 'Registration';
        $data['error'] = array();

        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[4]|max_length[16]');
        $this->form_validation->set_rules('tc', 'T&C', 'required');

        $this->load->view('templates/header', $data);
        if ($this->form_validation->run() === FALSE){
            $this->load->view('pages/registration', $data);
        }
        else
        {
            $ca = $this->registration_model->create_account();

            if(isset($ca[0]['error'])){
                foreach($ca as $caa){
                    $data['error'][] = $caa['msg'];
                }
                $this->load->view('pages/registration', $data);
            } else {
                $data['success'] = $ca;
                $this->success($data);
            }
        }
        $this->load->view('templates/footer', $data);
    }

    public function success($data)
    {
        $data['title'] = 'Successful registration';

        $this->load->library('login');
        $login = $this->login->login($data['success']['email'], $data['success']['password']);

        if($login){
            $this->load->view('pages/success', $data);
        } else {
            $this->index();
        }
    }

}
