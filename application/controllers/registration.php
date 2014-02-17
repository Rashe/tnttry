<?php
class Registration extends CI_Controller {

    function __construct()
    {
        parent::__construct();

        $this->load->library(array('form_validation', 'login_library'));
        $this->load->model(array('user_model', 'userstats_model'));
    }

    function index()
    {
        if(($this->session->userdata('user_name') != '')) {
            redirect();
        }

        $data['title'] = 'Registration';

        $this->form_validation->set_rules(array(
            array('field' => 'username', 'label' => 'Username',
                'rules' => 'trim|required|callback_username_exists|xss_clean'),
            array('field' => 'email', 'label' => 'Email',
                'rules' => 'trim|required|valid_email|callback_email_exists'),
            array('field' => 'password', 'label' => 'Password',
                'rules' => 'required|min_length[5]|max_length[20]'),
            array('field' => 'tc', 'label' => 'T&C', 'rules' => 'required')
        ));

        $this->form_validation->set_error_delimiters('<i class="error">', '</i>');

        if ($this->form_validation->run() === FALSE){
            $this->load->view('templates/header', $data);
            $this->load->view('pages/registration', $data);
        } else {
            $ca = $this->user_model->create_account();
            $this->userstats_model->add_user();

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
        if ($this->user_model->$exist($input)) {
            $this->form_validation->set_message($exist, ucfirst($name) . ' "' . $input . '" already exists!');
            return false;
        }
        return true;
    }
}
