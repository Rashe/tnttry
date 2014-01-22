<?php
class Login {

    private $CI;

    public function __construct()
    {
        $this->CI =& get_instance();

        $this->CI->load->helper(array('url', 'form'));
        $this->CI->load->model('usersession_model');
    }

    public function index()
    {
        if(($this->CI->session->userdata('user_name') != ''))
        {
            $data['username'] = $this->CI->session->userdata('user_name');
            return $this->getUserpanel($data, true);
        }

        $this->CI->load->library('form_validation');

        $this->CI->form_validation->set_rules('email', 'Email', 'required');
        $this->CI->form_validation->set_rules('password', 'Password', 'required');

        $email = $this->CI->input->post('email');
        $password = $this->CI->input->post('password');

        return $this->login($email, $password);
    }

    public function login($email, $password)
    {
        if(!$this->CI->usersession_model->login($email, $password)) {
            return $this->getUserpanel(null, false);
        }

        $data['username'] = $this->CI->session->userdata('user_name');
        return $this->getUserpanel($data, true);
    }

    private function getUserpanel($data = array(), $loggedIn)
    {
        $data['loggedIn'] = $loggedIn;
        return $this->CI->load->view('templates/userpanel', $data, true);
    }
}
