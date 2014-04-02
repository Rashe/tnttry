<?php
class Userdata extends CI_Controller {

    function __construct()
    {
        parent::__construct();

        $this->load->library(array('form_validation', 'login_library', 'email'));
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

    function get_forgot_password()
    {
        $this->load->view('templates/forgot_password');
    }

    function forgot_password()
    {
        $this->form_validation->set_rules(array(
            array('field' => 'username', 'label' => 'Username',
                'rules' => 'trim|required|callback_anti_hacking|xss_clean|callback_username_exists'),
            array('field' => 'email', 'label' => 'Email',
                'rules' => 'trim|required|valid_email|callback_anti_hacking|callback_email_username[' . $this->input->post('username', true) . ']')
        ))->set_error_delimiters('<i class="error">', '</i>');

        if ($this->form_validation->run() === true){
            $userdata = $this->user_model->new_password();

            $this->email->from('my@devochki.com', 'Devochki site');
            $this->email->to($userdata['email']);
            $this->email->subject('Your new password for Devochki site');
            $this->email->message('Dear ' . $userdata['username'] . ', Your new password is ' . $userdata['password']);

            if(!$this->email->send()){
                echo $this->email->print_debugger(); // todo: remove this line after debugging
            }

            return true;
        }

        return false;
    }

    function username_exists($input)
    {
        if (!$this->user_model->username_exists($input)) {
            $this->form_validation->set_message('username_exists', 'Username %s "' . $input . '" does not exist!');
            return false;
        }
        return true;
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

    function email_username($input, $username)
    {
        $userdata = $this->user_model->get_userdata($username);

        if(empty($userdata)) {
            $this->form_validation->set_message('email_username', 'Check your username!');
            return false;
        }

        if($userdata[0]['email'] != $input) {
            $this->form_validation->set_message('email_username', 'Email %s "' . $input . '" is not ok!');
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