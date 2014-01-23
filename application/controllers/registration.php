<?php
class Registration extends CI_Controller {

    public function __construct()
    {
        parent::__construct();

        $this->load->library(array('form_validation', 'login_library'));
        $this->load->model('registration_model');
    }

    public function index()
    {
        if(($this->session->userdata('user_name') != ''))
        {
            redirect();
        }

        $data['title'] = 'Registration';

        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[4]|max_length[16]');
        $this->form_validation->set_rules('tc', 'T&C', 'required');

        $data['error'] = array();
        if ($this->form_validation->run() === FALSE){
            $this->load->view('templates/header', $data);
            $this->load->view('pages/registration', $data);
        }
        else
        {
            $ca = $this->registration_model->create_account();

            if(isset($ca[0]['error'])){
                foreach($ca as $caa){
                    $data['error'][] = $caa['msg'];
                }
                $this->load->view('templates/header', $data);
                $this->load->view('pages/registration', $data);
            } else {
                $data['success'] = $ca;
                $login = $this->login_library->login($data['success']['email'], $data['success']['password']);

                if($login){
                    $data['title'] = 'Successful registration';
                    $data['userpanel'] = $login;
                    $this->load->view('templates/header', $data);
                    $this->load->view('pages/success', $data);
                } else {
                    $this->index();
                }
            }
        }

        $this->load->view('templates/footer');
    }

}
