<?php

/**
 * Class Pages
 *
 * Use http://localhost/tnttry/index.php/{page_name} to render pages
 */

class Pages extends CI_Controller {
    public function view($page = 'home')
    {
        if ( ! file_exists('application/views/pages/'.$page.'.php'))
        {
            show_404();
        }

        $data['title'] = ucfirst($page); // Capitalize the first letter

        $this->load->library('login_library');
        $data['userpanel'] = $this->login_library->userpanel();

        $this->load->view('templates/header', $data);
        $this->load->view('pages/'.$page, $data);
        $this->load->view('templates/footer', $data);
    }
}