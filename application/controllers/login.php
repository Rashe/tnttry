<?php
class Login extends CI_Controller {

    function __construct()
    {
        parent::__construct();
        $this->load->library(array('login_library', 'user_agent', 'email'));
        $this->load->model('user_model');
    }

    function index()
    {
        $email = $this->input->post('email', TRUE);
        $password = $this->input->post('password', TRUE);

        echo $this->login_library->login($email, $password) ? 'success' : 'fail';
    }

    function logout()
    {
        $this->session->unset_userdata(array(
            'user_id'    => '',
            'user_name'  => '',
            'user_email' => '',
            'logged_in'  => FALSE,
        ));
        $this->session->sess_destroy();

        redirect();
    }

    function forgot_password()
    {
        $username = $this->input->post('username', TRUE);
        $email = $this->input->post('email', TRUE);

        $userdata = $this->user_model->get_userdata($username);
        if(!isset($userdata[0])) return; // todo: username does not exist
        if($userdata[0]['email'] != $email) return; // todo: username or email is wrong

        $password = $this->generate_password();
        $this->user_model->update_userdata($username, $email, $password);

        $this->email->from('my@devochki.com', 'Devochki site');
        $this->email->to($email);
        $this->email->subject('Your new password for Devochki site');
        $this->email->message('Dear ' . $username . ', Your new password is ' . $password);
        $this->email->send();

        echo $this->email->print_debugger(); // todo: remove this line after debugging
    }

    function generate_password($length = 8)
    {
        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        $password = substr(str_shuffle($chars), mt_rand(0, strlen($chars) - $length), $length);
        return $password;
    }

    function get_forgot_password()
    {
        $this->load->view('templates/forgot_password');
    }
}
