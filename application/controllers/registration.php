<?php
class Registration extends CI_Controller {

    function __construct()
    {
        parent::__construct();

        $this->load->library(array('form_validation', 'login_library'));
        $this->load->model('registration_model');
    }

    function index()
    {
        if(($this->session->userdata('user_name') != '')) {
            redirect();
        }

        $data['title'] = 'Registration';

        $this->form_validation->set_rules('username', 'Username', 'required|callback_username_exists');
        $this->form_validation->set_rules('email', 'Email', 'required|callback_email_exists');
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[4]|max_length[16]');
        $this->form_validation->set_rules('tc', 'T&C', 'required');
        $this->form_validation->set_error_delimiters('<i class="error">', '</i>');

        if ($this->form_validation->run() === FALSE){
            $this->load->view('templates/header', $data);
            $this->load->view('pages/registration', $data);
        } else {
            $ca = $this->registration_model->create_account();

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

        $this->load->view('templates/footer');
    }

    function username_exists($username){
        return $this->exists($username, 'username');
    }

    function email_exists($email){
        return $this->exists($email, 'email');
    }

    private function exists($input, $name){
        $exist = $name . '_exists';
        if ($this->registration_model->$exist($input)) {
            $this->form_validation->set_message($exist, ucfirst($name) . ' "' . $input . '" already exists!');
            return false;
        }
        return true;
    }
}
