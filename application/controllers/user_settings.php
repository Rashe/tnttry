<?php
class User_settings extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->model('usersession_model');
        $this->load->model('userinfo_model');



    }

    public function index()
    {
        if(($this->session->userdata('user_name')==""))
        {
            $this->load->view('templates/header');
            $this->load->view('pages/registration');
            $this->load->view('templates/footer');
            return;
        }


        $this->load->helper('form');
        $this->load->library('form_validation');

        $data['title'] = 'User Settings';



        $this->form_validation->set_rules('email', 'Email', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[4]|max_length[16]');

        $this->load->view('templates/header', $data);
        if ($this->form_validation->run() === FALSE)
        {

            $data['userall']=$this->userinfo_model->get_alluserdata();

            $this->load->view('templates/user_settings', $data);
        }
        else
        {

            $password=hash('sha256', $this->input->post('password') . $this->input->post('email'));

            $this->usersession_model->update_settings();
            $this->load->view('pages/home');
//            $this->load->view('registration/success', $data);
        }
        $this->load->view('templates/footer', $data);
    }

}
