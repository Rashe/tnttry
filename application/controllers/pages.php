<?php

/**
 * Class Pages
 *
 * Use http://localhost/tnttry/index.php/{page_name} to render pages
 */

class Pages extends CI_Controller {

    function __construct()
    {
        parent::__construct();

        $this->load->library('userpanel');
    }

    function view($page = 'home')
    {
        if (!file_exists('application/views/pages/' . $page . '.php')) {
            show_404();
        }

        $data['title'] = ucfirst($page); // Capitalize the first letter
        $data['userpanel'] = $this->userpanel->getUserpanel();

        $this->load->view('templates/header', $data);
        $this->load->view('pages/'.$page, $data);
        $this->load->view('templates/footer', $data);
    }
}