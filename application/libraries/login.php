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
        // If user logged in show loggedin form
        if(($this->session->userdata('user_name')!=""))
        {
            $data['username'] = $this->session->userdata('user_name');
            return $this->load->view('templates/logedin', $data, TRUE);
        }

        $this->load->helper('form');
        $this->load->library('form_validation');

        $this->form_validation->set_rules('email', 'Email', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');

            $email=$this->input->post('email');

            $password=hash('sha256', $this->input->post('password') . $this->input->post('email'));

            $result=$this->usersession_model->login($email,$password);
//            if($result) $this->load->view('pages/home', NULL, TRUE);
//            else
            if(!$result) {
                return $this->load->view('templates/login', NULL, TRUE);
            }
    }
}
