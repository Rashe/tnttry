<?php
class Userdata extends CI_Controller {

    function __construct()
    {
        parent::__construct();

        $this->load->library(array('form_validation', 'login_library'));
        $this->load->model('user_model');
    }

    function index()
    {
        if(($this->session->userdata('user_name') == '')) {
            redirect();
        }

        $this->form_validation->set_rules(array(
            array('field' => 'email', 'label' => 'Email',
                'rules' => 'trim|required|valid_email|callback_anti_hacking|callback_email_exists'),
            array('field' => 'password', 'label' => 'Password',
                'rules' => 'required|min_length[5]|max_length[20]|callback_anti_hacking|xss_clean')
        ))->set_error_delimiters('<i class="error">', '</i>');

        if ($this->form_validation->run() === true){
            $this->user_model->change_userdata();
        }

        $data['title'] = 'Your settings, ' . $this->session->userdata('user_name');
        $data['email'] = $this->session->userdata('user_email');
        $data['userpanel'] = $this->login_library->userpanel();

        $this->load->view('templates/header', $data);
        $this->load->view('pages/userdata', $data);
        $this->load->view('templates/footer');
    }

    function email_exists($input)
    {
        if($input == $this->session->userdata('user_email')) return true;
        if ($this->user_model->email_exists($input)) {
            $this->form_validation->set_message('email_exists', '%s "' . $input . '" already exists!');
            return false;
        }
        return true;
    }

    function anti_hacking($input)
    {
        if($input != htmlspecialchars($input)){
            $this->form_validation->set_message('anti_hacking', 'Do not hack me, please');
            return false;
        }
        return true;
    }
}