<?php
class Registration extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        //$this->load->model('registration');
    }

    public function index()
    {
        //$this->load->helper('form');
        //$this->load->library('form_validation');

        $data['title'] = 'Registration';

        //$this->form_validation->set_rules('username', 'Username', 'required');
        //$this->form_validation->set_rules('email', 'Email', 'required');
        //$this->form_validation->set_rules('password', 'Password', 'required');

        $this->load->view('templates/header', $data);
//        if ($this->form_validation->run() === FALSE)
//        {
            $this->load->view('registration/index', $data);
/*        }
        else
        {
            $this->registration->create_account();
            $this->load->view('registration/success', $data);
        } */
        $this->load->view('templates/footer', $data);
    }

}
