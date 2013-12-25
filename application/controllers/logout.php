<?php
class Logout extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
//        $this->load->helper('form');
        $this->load->model('usersession_model');
//

    }

    public function index()
    {
        $newdata = array(
            'user_id'   =>'',
            'user_name'  =>'',
            'user_email'     => '',
            'logged_in' => FALSE,
        );
        $this->session->unset_userdata($newdata);
        $this->session->sess_destroy();
        $this->load->view('templates/header');
        $this->load->view('pages/home');
        $this->load->view('templates/footer');
    }


}
