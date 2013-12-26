<?php
class Make_post extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('posts_model');


    }

    public function index()
    {
        if (($this->session->userdata('user_name') == "")) {
            $this->load->view('templates/header');
            $this->load->view('pages/registration');
            $this->load->view('templates/footer');
            return;
        }

        $this->load->helper('form');
        $this->load->view('templates/make_post');

        $username =$this->session->userdata('user_name');
        $post_body=$this->input->post('post_body');

        $this->posts_model->make_post($username, $post_body);


    }

}
